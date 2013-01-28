<?php
/*
= Header for the bill.com calendar popup window = (user guide)
open source, modified by Steve Shen, Bill.com
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

<link rel="stylesheet" href="css/css.php" type="text/css">
<script src="common/toolbox.js"></script>
<script>window.onload = function() {winFit(500);}</script>
</head>

<body class="scroll">
<div class="topText">
<?php
echo '<h4 class="floatL">'.$pageTitle."</h4>\n";
echo '<div class="floatR"><a href="javascript:self.close()" target="_self">'.$xx['hdr_close_window']."</a></div>\n";
if ($_SESSION['uid'] > 1) { echo '<h5 class="floatC"><span class="footLB">Lux</span><span class="footLR">Cal</span> v'.LCV."</h5>\n"; }
?>
</div>
<div class="contentS">
