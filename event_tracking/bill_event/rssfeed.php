<?php
/*
= bill.com event tracking calendar RSS feeder =

Open source, modified by Steve Shen, Bill.com

*/
header("Content-Type: application/rss+xml; charset=utf-8");

//set session params
$_SESSION['uid'] = 1; //public access
$_SESSION['cC'] = array(0); //all categories

//load toolbox
require './common/toolbox.php';

//connect to database
$dbPfix = dbConnect();

//get settings from database
$set = getSettings();

//set time zone
date_default_timezone_set($set['timeZone']);

//get common functions
require './common/retrieve.php';

//set language
require './lang/ui-'.strtolower($set['language']).'.php';

//send feeds header
echo '<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0">
<channel>
<title>'.htmlspecialchars($set['calendarTitle']).' - RSS feed</title>
<link>'.$set['calendarUrl'].'</link>
<description>'.$xx['vws_events_for_next'].' '.$set['lookaheadDays'].' '.$xx['vws_days'].'</description>
<language>en-us</language>
<category>Calendar events</category>
<pubDate>'.date("r").'</pubDate>
<generator>LuxCal Web calendar</generator>'."\n";

$fromDate = date("Y-m-d", time() - 14*86400); //14 days back

$sDate = date("Y-m-d");
$eTime = time() + (($set['lookaheadDays']-1) * 86400); //Unix time of end date
$eDate = date("Y-m-d", $eTime);

$evtList = array();
retrieve($sDate,$eDate);

//process events and send feeds
if ($evtList) {
	foreach($evtList as $date => &$events) {
		foreach ($events as &$evt) {
			switch ($evt['r_t']) { //make repeat text
				case 0: $repeat = ""; break;
				case 1: $repeat = $xx['evt_repeat'].' '.$xx['evt_interval1_'.$evt['r_i']].' '.$xx['evt_period1_'.$evt['r_p']]; break;
				case 2: $repeat = $xx['evt_repeat_on'].' '.$xx['evt_interval2_'.$evt['r_i']].' '.$wkDays[$evt['r_p']].' '.$xx['of'].' '.($evt['r_m'] ? $months[$evt['r_m']-1] : $xx['evt_each_month']);
			}
			if ($evt['r_t'] > 0 and substr($evt['r_u'],0,2) == '20') {
				$repeat .= ' '.$xx['evt_until'].' '.IDtoDD($evt['r_u']);
			}
			$check = (strpos($evt['chk'], $date.'a') ? $evt['mk1'] : '').(strpos($evt['chk'], $date.'b') ? ' '.$evt['mk2'] : '');
			$feed  = "<item>\n";
			$feed .= "<title>".makeD($date,6).": ".$check.' '.htmlspecialchars($evt['tit'])."</title>\n";
			$feed .= "<link>".$set['calendarUrl']."?cD=".$date."</link>\n";
 			$feed .= "<description>\n<![CDATA[\n";
			$feed .= ($evt['sti'] == "" and $evt['eti'] == "") ? $xx['vws_all_day'] : $xx['vws_time'].": ".ITtoDT($evt['sti']);
			$feed .= ($evt['eti']) ? " - ".ITtoDT($evt['eti'])."\n" : "\n";
			if ($repeat) { $feed .= "<br>{$repeat}\n"; }
			if ($set['details4All']) {
				if ($evt['ven']) { $feed .= "<br>{$xx['vws_venue']}: {$evt['ven']}\n"; }
				if ($evt['des']) { $feed .= "<br>{$evt['des']}\n"; }
			}
			if ($set['showCatName']) { $feed .= "<br>{$xx['evt_category']}: {$evt['cnm']}\n"; }
			if ($set['showAdEd']) {
				$feed .= '<br>'.$xx['vws_added'].': '.IDtoDD($evt['ada']).' ('.$evt['una'].')';
				if ($evt['mda'] and $evt['edr']) { $feed .= '<br>'.$xx['vws_edited'].': '.IDtoDD($evt['mda']).' ('.$evt['edr'].')'; }
			}
			$feed .= "]]>\n</description>\n";
			$feed .= "<guid isPermaLink='false'>".$set['calendarUrl']."?evt=".$evt['eid'].'&amp;'.$date."</guid>\n";
			$feed .= "</item>\n";
			echo $feed;
		}
	}
} else { //no events due
	echo "<item>
		<description>\nNo events due in the next ".$set['lookaheadDays']." days.\n</description>
		<guid isPermaLink='false'>".$set['calendarUrl']."</guid>
		</item>\n";
}
echo "</channel>\n</rss>";
?>
