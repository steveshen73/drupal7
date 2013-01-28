<?php 
  $filehandle = 
    fopen("http://www.google.com/complete/search?hl=en&js=true&qu=" . $_GET["qu"], "r"); 
  while (!feof($filehandle)){
    $download = fgets($filehandle);
    echo $download;
  }
  fclose($filehandle);
?>
