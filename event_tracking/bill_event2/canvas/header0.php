<?php
/*
= Header for the LuxCal calendar pages = (no Top bar, no Nav bar)
modified by Steve Shen, bill.com

*/

//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $set['calendarTitle']; ?></title>

<link rel="shortcut icon" href="http://www.bill.com/misc/favicon.ico">

<link rel="stylesheet" href="css/css.php" type="text/css"/>
<link rel="stylesheet" href="css/css_xs.php" type="text/css"/>
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
<div class="content">
<?php
if ($pageTitle) echo '<br><h4 class="pageTitle">'.$pageTitle.'</h3>';
?>
