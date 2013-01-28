<?php

require_once "simple_html_dom.php";
// Create DOM from URL or file
$html = file_get_html('http://www.bill.com/');

// Find all images
foreach($html->find('img') as $element)
      {
       echo $element->src . '<br>';
      }
      echo "</br></br>". count($html->find('img')). " images.";
      echo "</br></br>";
     
// Find all links

foreach($html->find('a') as $element)
     {
       echo $element->href . '<br>'; 
     }
     echo "</br></br>". count($html->find('a')). " links.";
?>

