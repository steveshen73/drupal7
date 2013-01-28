<?php ob_start(); //Turn on output buffering ?>
Hello world, <a href="http://www.blogger.com/myotherpage.php">link</a>
<div class="style">Content</div>
<?php $var = ob_get_clean(); //copy current buffer contents into $var message variable and delete current output buffer 
  echo $var;
?>
