<?php
/*
= LuxCal event calendar - BOM removing utility =

© Copyright 2009-2012  LuxSoft - www.LuxSoft.eu

This file is part of the LuxCal Web Calendar.

Files with utf-8 character encoding may have a three-byte signature, called BOM 
(Byte Order Mask), at the beginning of the file. The BOM defines the byte order 
("little-endian" or "big-endian") for multi-byte characters and can sometimes 
cause unexpected characters to appear at the top of a web page.

=================================================================================
For the LuxCal language files we recommend character encoding "utf-8 without BOM"
=================================================================================

This script should be run from the lang/ folder. It will read the language files 
in the current folder and removes the BOM, if present, from the beginning of each 
language file (ai-{lang}.php, ug-{lang}.php and ui-{lang}.php files).
*/

//init
$dir = "./";
$files = $boms = 0;
echo "== LuxCal BOM Removing Utility ==<br><br>";

//do it!
if (is_dir($dir)) {
		if ($curDir = opendir($dir)) {
			while (($fileName = readdir($curDir)) !== false) { //read file name
				if (preg_match("%(ai-|ug-|ui-)\w+\.php$%i",$fileName)) { //language files only
					$string = file_get_contents($dir.$fileName);
					$files++;
					if(substr($string,0,3) == pack('CCC',0xef,0xbb,0xbf)) { //hex representation of BOM
						$string = substr($string,3); //remove BOM
						$boms++;
					}
					file_put_contents($dir.$fileName, $string);
				}
			}
			closedir($curDir);
		} else { //no permission?
			exit("unable to open directory $dir");
		}
} else { //run from lang/ directory
	exit("$dir is not a directory - run this utility from the lang/ directory");
}

//display results
if ($files) {
	echo "Number of files processed: ".$files."<br>Number of BOMs removed: ".$boms;
} else {
	echo "No language files found";
}
?>
