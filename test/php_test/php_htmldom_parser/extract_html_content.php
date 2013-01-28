<?php

require_once "simple_html_dom.php";
// Dump contents (without tags) from HTML
echo file_get_html('http://www.bill.com/')->plaintext; 
?>

