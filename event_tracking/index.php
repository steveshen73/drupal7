<?php
// At line 2 of our calendar.php script, add the MySQL connection information:
$mysql = mysql_connect("localhost", "root", "mysql88");
mysql_select_db("event", $mysql) or die(mysql_error());

// Now we need to define "A DAY", which will be used later in the script:
define("ADAY", (60*60*24));

// The rest of the script will stay the same until about line 82

if ((!isset($_POST['month'])) || (!isset($_POST['year']))) {
	$nowArray = getdate();
	$month = $nowArray['mon'];
	$year = $nowArray['year'];
} else {
	$month = $_POST['month'];
	$year = $_POST['year'];
}
$start = mktime(12,0,0,$month,1,$year);
$firstDayArray = getdate($start);
?>
<html>
<head>
<title><?php echo "Calendar: ".$firstDayArray['month']." " . $firstDayArray['year']; ?></title>
</head>
<script type="text/javascript">
function eventWindow(url) {
	 event_popupWin = window.open(url, 'event', 'resizable=yes,scrollbars=yes,toolbar=no,width=400,height=400');
	 event_popupWin.opener = self;
}
</script>
<body>
<h2>Select a Month/Year</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<select name="month">
<?php
$months = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

for ($x=1; $x<=count($months); $x++){
	echo "<option value=\"$x\"";
	if ($x == $month){
		echo " selected";
	}
	echo ">".$months[$x-1]."</option>";
}
?>
</select>

<?php $thisYear = date('Y');?>
<select name="year"> 
<?php 
for ($x=$thisYear - 70; $x<=$thisYear + 15; $x++){ 
        echo "<option"; 
        if ($x == $year){ 
                echo " selected"; 
        } 
        echo ">$x</option>"; 
}
?>

</select>
<input type="submit" name="submit" value="Go!">
</form>
<br />
<?php
$days = Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
echo "<table border=\"1\" cellpadding=\"5\"><tr>\n";
foreach ($days as $day) {
	echo "<td style=\"background-color: #CCCCCC; text-align: center; width: 14%\">
	      <strong>$day</strong></td>\n";
}

for ($count=0; $count < (6*7); $count++) {
	$dayArray = getdate($start);
	if (($count % 7) == 0) {
		if ($dayArray["mon"] != $month) {
			break;
		} else {
			echo "</tr><tr>\n";
		}
	}
	if ($count < $firstDayArray["wday"] || $dayArray["mon"] != $month) {
		echo "<td> </td>\n";
	} else {
		$chkEvent_sql = "SELECT event_title FROM calendar_events WHERE month(event_start) = '".$month."' AND dayofmonth(event_start) = '".$dayArray["mday"]."' AND year(event_start) = '".$year."' ORDER BY event_start";
		$chkEvent_res = mysql_query($chkEvent_sql, $mysql) or die(mysql_error($mysql));

		if (mysql_num_rows($chkEvent_res) > 0) {
			$event_title = "<br/>";
			while ($ev = mysql_fetch_array($chkEvent_res)) {
				$event_title .= stripslashes($ev["event_title"])."<br/>";
			}
			mysql_free_result($chkEvent_res);
		} else {
			$event_title = "";
		}

		echo "<td valign=\"top\"><a href=\"javascript:eventWindow('event.php?m=".$month."&d=".$dayArray["mday"]."&y=$year');\">".$dayArray["mday"]."</a><br/>".$event_title."</td>\n";

		unset($event_title);

		$start += ADAY;
	}
}
echo "</tr></table>";
mysql_close($mysql);
?>
</body>
</html>


