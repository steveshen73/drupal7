<?php
/*
= Header for the bill.com calendar pages = (for mobile devices)
open source , modified by Steve Shen, bill.com
*/

//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only

//initialize
$set['weekNumber'] = 0; //reduce width
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $set['calendarTitle']; ?></title>
<meta name="description" content="web calendar">
<meta name="keywords" content="bill.com web calendar">
<meta name="robots" content="nofollow">
<!--[if IE]>
<meta http-equiv="imagetoolbar" content="no">
<![endif]-->

<link rel="shortcut icon" href="http://www.bill.com/misc/favicon.ico">

<?php
echo '<link rel="canonical" href="'.$set['calendarUrl'].'"/>'."\n";
if ($privs > 0 and $set['rssFeed']) {
	echo '<link rel="alternate" type="application/rss+xml" title="LuxCal RSS Feed" href="'.$set['calendarUrl'].'rssfeed.php">'."\n";
}
?>
<link rel="stylesheet" href="css/css.php" type="text/css">
<script>
<?php //used by dtpicker.js
echo 'var mode = "',$mode,'";
var dFormat = ',$set['dateFormat'],';
var dSepar = "',$set['dateSep'],'";
var time24 = ',$set['time24'],';
var wStart = ',$set['weekStart'],';
var dpToday = "',$xx['hdr_today'],'";
var dpClear = "',$xx['hdr_clear'],'";
var dpMonths = new Array("',implode('","',$months),'");
var dpWkdays = new Array("',implode('","',$wkDays_m),'");
var dwTimeSlot = ',$set['dwTimeSlot'],';'."\n"; //used by dw_functions.php
?>
</script>
<script src="common/dtpicker.js"></script>
<script src="common/cpicker.js"></script>
<script src="common/toolbox.js"></script>
</head>

<body>
<?php
echo "<header>\n";
echo $uname."\n";
echo "</header>\n";
echo "<div class=\"navBar noPrint\">\n";
if ($privs > 0) { //view rights
	echo "<div class=\"floatR\">\n";
	if ($privs > 1) { //post rights
		echo '<button type="button" title="'.$xx['hdr_add_event']."\" onclick=\"newE();\">&nbsp;+&nbsp;</button>\n";
	}
	if ($_SESSION['uid'] == 1) { //public user
		echo '<button type="button" onclick="login()">'.$xx['hdr_log_in']."</button>\n";
	} else { //known user
		echo '<button type="button" onclick="logout()">'.$xx['hdr_log_out']."</button>\n";
	}
	echo "</div>\n";
	echo '<button type="button" title="'.$xx['hdr_options_panel']."\" onclick=\"show('optPanel','optMenu')\">".$xx['hdr_options']."</button>\n";
	echo "<form class=\"inline\" method=\"post\" id=\"gotoD\" name=\"gotoD\" action=\"index.php\">\n";
	echo '<input style="width:60px;" type="text" name="newD" id="newD" value="'.IDtoDD($_SESSION['cD'])."\"/>\n";
	echo '<button type="button" title="'.$xx['hdr_select_date']."\" onclick=\"dPicker(0,'gotoD','newD');return false;\">&larr;</button>\n";
	echo "</form>\n";

	//make options panel
	echo "<div id='optPanel'>\n";
	echo '<h4 class="floatC">'.$xx['hdr_options_submit']."</h4>\n";
	echo "<form name=\"optMenu\" method=\"post\" action=\"index.php\">\n";
	echo "<table class=\"options\">\n";
	echo "<tr>\n";
	echo '<th title="'.$xx['hdr_select_view'].'">'.$xx['hdr_view']."</th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><div class=\"optList\">\n";
	echo '<input type="checkbox" id="cP1" name="cP" value="1" onclick="check1(\'cP\',this);"'.($cP == "1" ? ' checked="checked"' : '').'/><label for="cP1"> '.$xx['hdr_year']."</label><br>\n";
	echo '<input type="checkbox" id="cP2" name="cP" value="2" onclick="check1(\'cP\',this);"'.($cP == "2" ? ' checked="checked"' : '').'/><label for="cP2"> '.$xx['hdr_month_full']."</label><br>\n";
	echo '<input type="checkbox" id="cP3" name="cP" value="3" onclick="check1(\'cP\',this);"'.($cP == "3" ? ' checked="checked"' : '').'/><label for="cP3"> '.$xx['hdr_month_work']."</label><br>\n";
	echo '<input type="checkbox" id="cP4" name="cP" value="4" onclick="check1(\'cP\',this);"'.($cP == "4" ? ' checked="checked"' : '').'/><label for="cP4"> '.$xx['hdr_week_full']."</label><br>\n";
	echo '<input type="checkbox" id="cP5" name="cP" value="5" onclick="check1(\'cP\',this);"'.($cP == "5" ? ' checked="checked"' : '').'/><label for="cP5"> '.$xx['hdr_week_work']."</label><br>\n";
	echo '<input type="checkbox" id="cP6" name="cP" value="6" onclick="check1(\'cP\',this);"'.($cP == "6" ? ' checked="checked"' : '').'/><label for="cP6"> '.$xx['hdr_day']."</label><br>\n";
	echo '<input type="checkbox" id="cP7" name="cP" value="7" onclick="check1(\'cP\',this);"'.($cP == "7" ? ' checked="checked"' : '').'/><label for="cP7"> '.$xx['hdr_upcoming']."</label><br>\n";
	echo '<input type="checkbox" id="cP8" name="cP" value="8" onclick="check1(\'cP\',this);"'.($cP == "8" ? ' checked="checked"' : '').'/><label for="cP8"> '.$xx['hdr_changes']."</label>\n";
	echo "</div></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	echo "</form>\n";
	echo "</div>\n";
} else { //display dummy navbar
	echo "&nbsp;<div class=\"floatR\">\n";
	echo '<button type="button" onclick="login()">'.$xx['hdr_log_in']."</button>\n";
	echo "</div>\n";
}
echo "</div>\n";
echo "<div class=\"content\">\n";

if ($pageTitle) echo '<br><h3 class="pageTitle">'.$pageTitle.'</h3>'."\n";
?>
