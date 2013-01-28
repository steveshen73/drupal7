<?php
/*
= calendar day view =

Open source, modified by Steve Shen, Bill.com
This file is part of the Bill.com Web Calendar.
*/

//sanity check
if (!defined('LCC')) { exit('not permitted ('.substr(basename(__FILE__),0,-4).')'); } //lounch via script only

//initialize
require './views/dw_functions.php';

$cD = $_SESSION['cD'];
$tcDate = mktime( 0, 0, 0, substr($cD,5,2), substr($cD,8,2), substr($cD,0,4) ); //Unix time of cD
$nextDay = date( "Y-m-d", $tcDate + 86400 );
$prevDay = date( "Y-m-d", $tcDate - 86400 );

retrieve($cD,$nextDay,'uc'); //grab events

/* display header*/
$header = '<span'.($mobile ? '' : ' class="viewHdr"').'>'.makeD($cD,6).'</span>';
echo '<h4 class="floatC"><a class="noPrint" href="index.php?cD=',$prevDay,'"><img src="images/arrowl.png" alt="back"/></a>',$header,'<a class="noPrint" href="index.php?cD=',$nextDay,'"><img src="images/arrowr.png" alt="forward"/></a></h4>'."\n";

/* display day headers */
echo '<div'.($mobile ? '' : ' class="scrollBoxHead"').">\n";
echo '<table class="grid">'."\n";
echo '<tr><th class="tCol">'.$xx['vws_time'].'</th><th class="dCol">'.$xx['vws_events']."</th></tr>\n";
echo "</table>\n";
echo "</div>\n";

/* display day */
echo '<div'.($mobile ? '' : ' class="scrollBoxDa"').">\n";
echo '<table class="grid">'."\n";
echo '<tr><td class="tCol tColBg">'."\n";
showHours();
echo '</td><td class="dColBg">'."\n";
showDay($cD,$xx['vws_events']);
echo '</td></tr></table>';
echo "</div>\n";
?>
