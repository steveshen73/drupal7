<?php
/*
= week view of events =
Open source, modified by Steve Shen, Bill.com
This file is part of the Bill.com Web Calendar.
*/

//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only

//initialize
require './views/dw_functions.php';

$cD = $_SESSION['cD'];
$d = substr($cD,8,2);
$m = substr($cD,5,2);
$y = substr($cD,0,4);
$days = ($mode == 'fw') ? '1234567' : $set['workWeekDays']; //days to show
$day_of_week = ($set['weekStart']) ? date("N", mktime(0,0,0,$m,$d,$y))-1 : date("w", mktime(0,0,0,$m,$d,$y)); //Monday - Sunday : Sunday - Saturday
$sDow = $d-$day_of_week; //first day of week
$sDayOfWk = date("Y-m-d", mktime(0,0,0,$m,$sDow,$y));
$eDayOfWk = date("Y-m-d", mktime(0,0,0,$m,$sDow+substr($days,-1)-1,$y));
$sDoLastW = date("Y-m-d", mktime(0,0,0,$m,$sDow-7,$y));
$sDoNextW = date("Y-m-d", mktime(0,0,0,$m,$sDow+7,$y));

retrieve($sDayOfWk,$sDoNextW,'uc');

/* display header */
$weekNr = $set['weekNumber'] ? ' ('.$xx['vws_week'].' '.date('W', mktime(0,0,0,$m,$sDow+1,$y)).')' : '';
$header = '&nbsp;<span'.($mobile ? '' : ' class="viewHdr"').'>'.makeD($sDayOfWk,2).' - '.makeD($eDayOfWk,2).$weekNr.'</span>&nbsp;';
echo '<h4 class="floatC"><a class="noPrint" href="index.php?cD=',$sDoLastW,'"><img src="images/arrowl.png" alt="back"/></a>',$header,'<a class="noPrint" href="index.php?cD=',$sDoNextW,'"><img src="images/arrowr.png" alt="forward"/></a></h4>'."\n";

$cWidth = round(98 / strlen($days),1).'%';

/* display day headers */
echo '<div'.($mobile ? '' : ' class="scrollBoxHead"').">\n";
echo '<table class="grid" width="988px">'."\n";
echo '<tr><th class="tCol">'.$xx['vws_time']."</th>\n";
for ($i=0;$i<7;$i++) {
	$cTime = mktime(0,0,0,$m,$sDow+$i,$y); //current time
	if (strpos($days,date("N",$cTime)) !== false) {
		$sDate = date("Y-m-d",$cTime);
		echo "<th class=\"dCol point\" style=\"width:$cWidth\" onclick=\"goDay('".$sDate."');\" title=\"".$xx['vws_view_day']."\">".makeD($sDate,($mobile ? 1 : 5),'m3')."</th>\n";
	}
}
echo "</tr>\n</table>";
echo "</div>";

/* display days */
echo '<div'.($mobile ? '' : ' class="scrollBoxWe"').">\n";
echo '<table class="grid">'."\n";
echo '<tr><td class="tCol tColBg">'."\n";
showHours();
echo "</td>\n";
for ($i=0;$i<7;$i++) {
	$cTime = mktime(0,0,0,$m,$sDow+$i,$y); //current time
	$cDate = date("Y-m-d", $cTime); //current date
	if (strpos($days,date("N",$cTime)) !== false) {
		$dow = "<td class=\"dCol ".((date("N", $cTime) > 5) ? "we0" : "wd0"); //week end or week day
		if ($cDate == date("Y-m-d")) {
			$dow .= ' today';
		} elseif (isset($_SESSION['nD']) and $cDate == $_SESSION['nD']) {
			$dow .= ' slday';
		}
		$dow .= '"';
		echo $dow." style=\"width:$cWidth\">\n";
		showDay(date("Y-m-d",$cTime));
		echo "</td>\n";
	}
}
echo "</tr>\n</table>\n";
echo "</div>\n";
?>
