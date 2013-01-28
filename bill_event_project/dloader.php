<?php
/*= file downloader script =
Open source, modified by Steve Shen, Bill.com
*/

//sanity check
if (!isset($_GET['fName'])) { exit('not permitted - no file name ('.substr(basename(__FILE__),0,-4).')'); } //no file name
if (!preg_match('%^[^+,()|&@<>\s]{1,40}\.[\w]{3}$%', $_GET['fName'])) { exit('not permitted - invalid file name ('.substr(basename(__FILE__),0,-4).')'); } //invalid file name

$fName = $_GET['fName'];
$rName = $_GET['rName'];
$dName = './files/';
if (file_exists($dName.$fName)) { //file valid
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=$rName");
	readfile($dName.$fName); //send download
} else {
	echo "File not present";
}
?>
