<?php
/*
= iCal event file export script =
Open source, modified by Steve Shen, Bill.com
*/

//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only

//initialize
$adminLang = (file_exists('./lang/ai-'.strtolower($_SESSION['cL']).'.php')) ? $_SESSION['cL'] : "English";
require './lang/ai-'.strtolower($adminLang).'.php';

$fileName = (isset($_POST['fileName'])) ? $_POST['fileName'] : ""; //file name
$fileDes = (isset($_POST['fileDes'])) ? stripslashes(strip_tags(trim($_POST['fileDes']))) : ""; //file description
$usrName = (isset($_POST['usrName'])) ? $_POST['usrName'] : ""; //user filter
$catName = (isset($_POST['catName'])) ? $_POST['catName'] : ""; //category filter
$fromDda = (isset($_POST['fromDda'])) ? DDtoID($_POST['fromDda']) : ""; //from event due date
$fromMda = (isset($_POST['fromMda'])) ? DDtoID($_POST['fromMda']) : ""; //from event modified date
$tillDda = (isset($_POST['tillDda'])) ? DDtoID($_POST['tillDda']) : ""; //untill event due date
$tillMda = (isset($_POST['tillMda'])) ? DDtoID($_POST['tillMda']) : ""; //untill event modified date

$meta = array(); //iCal meta data
$calProps = array("PRODID","VERSION"); //iCal properties and components of interest


/* sub-functions */

function catList($selCat) {
	global $ax;
	$rSet = dbQuery("SELECT name, color, background FROM [db]categories WHERE status >= 0 ORDER BY sequence");
	if ($rSet !== false) {
		echo '<option value="*">'.$ax['iex_all_cats']."&nbsp;</option>\n";
		while ($row = mysql_fetch_assoc($rSet)) {
			$selected = ($selCat == $row['name']) ? " selected=\"selected\"" : "";
			$catColor = ($row['color'] ? "color:".$row['color'].";" : "").($row['background'] ? "background-color:".$row['background'].";" : "");
			echo '<option value="'.$row['name'].'"'.($catColor ? " style=\"".$catColor."\"" : "").$selected.'>'.$row['name']."</option>\n";
		}
	}
}

function userMenu($selUser) {
	global $ax;
	$rSet = dbQuery("SELECT user_name FROM [db]users ORDER BY user_name");
	if ($rSet !== false) {
		echo '<option value="*">'.$ax['iex_all_users']."&nbsp;</option>\n";
		while ($row=mysql_fetch_assoc($rSet)) {
			$selected = ($selUser == $row['user_name']) ? " selected=\"selected\"" : "";
			echo "<option value=\"".$row['user_name']."\"".$selected.">".stripslashes($row['user_name'])."</option>\n";
		}
	}
}


/* main functions */

function selectEvents() {
	global $ax, $msg, $fileName, $fileDes, $usrName, $catName, $fromDda, $fromMda, $tillDda, $tillMda;
	
	echo '<form action="index.php" method="post">'."\n";
	echo '<table class="fieldBox">'."\n";
	echo '<tr><td class="legend" colspan="2">&nbsp;'.$ax['iex_create_ics'].'&nbsp;</td></tr>'."\n";
	echo '<tr><td class="label">'.$ax['iex_file_name'].':</td><td><input type="text" name="fileName" value="'.$fileName."\" maxlength='40' size='26'/> .ics</td></tr>\n";
	echo '<tr><td class="label">'.$ax['iex_file_description'].':</td><td><input type="text" name="fileDes" value="'.$fileDes."\" maxlength='50' size='30'/></td></tr>\n";
	echo '<tr><td colspan="2"><hr></td>'."</tr>\n";
	echo '<tr><td colspan="2">'.$ax['iex_filters']."</td></tr>\n";
	echo '<tr><td class="label">'.$ax['iex_owner'].':</td><td><select name="usrName" >'."\n";
	userMenu($usrName);
	echo "</select></td></tr>\n";
	echo '<tr><td class="label">'.$ax['iex_category'].':</td><td><select name="catName" >'."\n";
	catList($catName);
	echo "</select></td></tr>\n";
	echo '<tr><td class="label">'.$ax['iex_occurring_between'].':</td><td>';
	echo '<input type="text" name="fromDda" id="fromDda" value="'.IDtoDD($fromDda)."\" size='8'/>\n";
	echo '<button title="'.$ax['iex_select_start_date']."\" onclick=\"dPicker(1,'nill','fromDda');return false;\">&larr;</button> &#8211; ";
	echo '<input type="text" name="tillDda" id="tillDda" value="'.IDtoDD($tillDda)."\" size='8'/>\n";
	echo '<button title="'.$ax['iex_select_end_date']."\" onclick=\"dPicker(1,'nill','tillDda');return false;\">&larr;</button></td></tr>\n";
	echo '<tr><td class="label">'.$ax['iex_changed_between'].':</td><td>';
	echo '<input type="text" name="fromMda" id="fromMda" value="'.IDtoDD($fromMda)."\" size='8'/>\n";
	echo '<button title="'.$ax['iex_select_start_date']."\" onclick=\"dPicker(1,'nill','fromMda');return false;\">&larr;</button> &#8211; \n";
	echo '<input type="text" name="tillMda" id="tillMda" value="'.IDtoDD($tillMda)."\" size='8'/>\n";
	echo '<button title="'.$ax['iex_select_end_date']."\" onclick=\"dPicker(1,'nill','tillMda');return false;\">&larr;</button></td></tr>\n";
	echo "</table>\n";
	echo '<input class="noPrint" type="submit" name="create" value="'.$ax['iex_create_file'].'"/>'."\n";
	if (isset($_POST['create']) and $msg == $ax['iex_file_created']) {
		$fName = ($fileName ? $fileName.'.ics' : 'luxcal.ics');
		$rName = str_replace('.','-'.date("Ymd-Hi").'.',$fName);
		echo '&nbsp;&nbsp;&nbsp;&nbsp;<button class="noPrint" type="button" onclick="location.href=\'dloader.php?fName='.$fName.'&rName='.$rName.'\'">'.$ax['iex_download_file']."</button>\n";
	}
	echo "</form>\n";
	echo '<div style="clear:right"></div>'."\n";
}

function makeFile() {
	global $ax, $evtList, $set, $fileName, $fileDes, $usrName, $catName, $fromDda, $fromMda, $tillDda, $tillMda;

	$icsHead = "BEGIN:VCALENDAR\r\n";
	$icsHead .= "VERSION:2.0\r\n";
	$icsHead .= "METHOD:PUBLISH\r\n";
	$icsHead .= "PRODID:- // LuxCal ".constant('LCV')." // ".$set['calendarTitle']." // EN\r\n";
	$icsHead .= "X-LC-CONTENT:user: ".(($usrName != '*') ? $usrName : "all");
	$icsHead .= " // cat: ".(($catName != '*') ? $catName : "all");
	$icsHead .= " // due: ".(($fromDda) ? $fromDda : "begin")." - ".(($tillDda) ? $tillDda : "end");
	$icsHead .= " // mod: ".(($fromMda) ? $fromMda : "begin")." - ".(($tillMda) ? $tillMda : "end")."\r\n";
	$icsHead .= "X-WR-CALNAME:".(($fileDes) ? $fileDes : "Events")."\r\n";
	$icsHead .= "X-WR-TIMEZONE:".date_default_timezone_get()."\r\n";
	$icsHead .= "CALSCALE:GREGORIAN\r\n";

	//set event filter
	$filter = ($usrName != '*') ? " AND u.user_name = '$usrName'" : "";
	if ($catName != '*') { $filter .= " AND c.name = '$catName'"; }
	if ($fromMda) { $filter .= " AND e.m_date >= '$fromMda'"; }
	if ($tillMda) { $filter .= " AND e.m_date <= '$tillMda'"; }

	//set event date range
	$sRange = ($fromDda) ? $fromDda : date('Y-m-d',time()-31536000); //-1 year
	$eRange = ($tillDda) ? $tillDda : date('Y-m-d',time()+31536000); //+1 year

	retrieve($sRange,$eRange,'',substr($filter,5)); //grab events
	
	if (count($evtList) == 0) { return $ax['iex_no_events_found']; }

	$icsBody = "";
	$from = array(',',';','<br>');
	$to = array('\,','\;','\n');
	$eidDone = array(); //events processed
	foreach ($evtList as $evtListDate) {
		foreach ($evtListDate as $evt) {
			if (!in_array($evt['eid'], $eidDone)) { //event not yet processed
				$vDescription = str_replace($from,$to,trim($evt['des']));
				$vDescription = rtrim(chunk_split($vDescription,72,"\r\n\t")); //fold to 72 chars line length
				//compile DTSTART and DTEND values
				$dateS = str_replace('-','',$evt['sda']);
				$dateE = ($evt['eda'][0] != '9') ? str_replace('-','',$evt['eda']) : $dateS;
				$timeS = str_replace(':','',$evt['sti']);
				$timeE = str_replace(':','',$evt['eti']);
				if ($timeS == "" and $timeE == "") { //all day
					$allDay = true;
					$dateE = date('Ymd', mktime (0, 0, 0, substr($dateE,4,2), substr($dateE,6,2)+1, substr($dateE,0,4))); //+1 day
				} else {
					$allDay = false;
					$dateS .= "T".$timeS.'00';
					$dateE .= "T".(($timeE) ? $timeE.'00' : $timeS.'01');
				}

				//compile RRULE property
				$rrule = "";
				if ($evt['r_t'] == 1) { //every 1|2|3|4 d|w|m|y
					$rrule .= "FREQ=";
					switch ($evt['r_p']) {
						case 1: $rrule .= 'DAILY'; break;
						case 2: $rrule .= 'WEEKLY'; break;
						case 3: $rrule .= 'MONTHLY'; break;
						case 4: $rrule .= 'YEARLY';
					}
					$rrule .= ";INTERVAL=".$evt['r_i'];
				}
				if ($evt['r_t'] == 2) { //every 1|2|3|4|5 m|t|w|t|f|s|s of the month
					$rrule .= $evt['r_m'] ? "FREQ=YEARLY" : "FREQ=MONTHLY";
					$rrule .= ";BYDAY=".(($evt['r_i'] != 5) ? $evt['r_i'] : '-1');
					switch ($evt['r_p']) {
						case 1: $rrule .= 'MO'; break;
						case 2: $rrule .= 'TU'; break;
						case 3: $rrule .= 'WE'; break;
						case 4: $rrule .= 'TH'; break;
						case 5: $rrule .= 'FR'; break;
						case 6: $rrule .= 'SA'; break;
						case 7: $rrule .= 'SU';
					}
					if ($evt['r_m']) {
						$rrule .= ";BYMONTH=".$evt['r_m'];
					}
				}
				if ($evt['r_u'][0] != '9') {
					$rrule .= ";UNTIL=".$evt['r_u'];
				}
				$tStamp = mktime(substr($timeS,0,2), substr($timeS,2,2), 0, substr($dateS,4,2), substr($dateS,6,2), substr($dateS,0,4));
				$icsBody .= "BEGIN:VEVENT\r\n";
				$icsBody .= "DTSTAMP:".gmdate('Ymd\THis\Z')."\r\n";
				if ($evt['ada']) {
					$icsBody .= "CREATED:".gmdate('Ymd\THis\Z', mktime (0, 0, 0, substr($evt['ada'],5,2), substr($evt['ada'],8,2)+1, substr($evt['ada'],0,4)))."\r\n";
				}
				if ($evt['mda']) {
					$icsBody .= "LAST-MODIFIED:".gmdate('Ymd\THis\Z', mktime (0, 0, 0, substr($evt['mda'],5,2), substr($evt['mda'],8,2)+1, substr($evt['mda'],0,4)))."\r\n";
				}
				$icsBody .= "UID:".gmdate("Ymd\THis\Z", $tStamp).trim(substr($evt['tit'],0,4))."-LuxCal@".$set['calendarUrl']."\r\n";
				$icsBody .= "SUMMARY:".str_replace(",","\,",$evt['tit'])."\r\n";
				if ($evt['des']) { $icsBody .= "DESCRIPTION:".$vDescription."\r\n"; }
				$icsBody .= "CATEGORIES:".str_replace(",","\,",$evt['cnm'])."\r\n";
				if ($evt['ven']) { $icsBody .= "LOCATION:".str_replace(",","\,",$evt['ven'])."\r\n"; }
				if ($rrule) { $icsBody .= "RRULE:".$rrule."\r\n"; }
				$icsBody .= "DTSTART;".($allDay ? "VALUE=DATE" : "TZID=".date_default_timezone_get()).":".$dateS."\r\n";
				$icsBody .= "DTEND;".($allDay ? "VALUE=DATE" : "TZID=".date_default_timezone_get()).":".$dateE."\r\n"; //+1 ?
				$icsBody .= "END:VEVENT\r\n";
				$eidDone[] = $evt['eid']; //mark as processed
			}
		}
	}
	$icsTail = "END:VCALENDAR";
	//save to iCal file
	$fullfName = "./files/".($fileName ? $fileName : "luxcal").".ics";
	if (file_put_contents($fullfName, $icsHead.$icsBody.$icsTail, LOCK_EX) !== false) {
		$result = $ax['iex_file_created'];
	} else {
		$result = $ax['iex_write error'];
	}
	return $result;
}


//control logic

$msg = ""; //init
if ($admin) {
	if (isset($_POST['create'])) {
		$msg = makeFile();
	}
	echo '<br><p class="error">'.$msg."</p>\n";
	echo "<div class=\"scrollBoxAd\">\n";
	echo '<aside class="aside">'.$ax['xpl_export_ical']."</aside>\n";
	echo "<div class=\"centerBox\">\n";
	selectEvents();
	echo "</div>\n";
	echo "</div>\n";
} else {
	echo "<p class=\"error\">".$ax['no_way']."</p>\n";
}
?>
