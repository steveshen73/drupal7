<?php
$x = new SimpleXMLElement(<<<EOXML
<root>
   <node>Some Text</node>
   <node>other text</node>
</root>
EOXML
);

$nodes = $x->xpath('/root/node');

// This does not work
// $nodes[0] = "My New Text";
$nodes[0][0] = "My New Text";
$nodes[1][0] = "my other new text";

echo "<pre>"; //using <pre> to get a line break for each node
echo $x->asXML(); //Gets an XML string from a SimpleXML element
echo "</pre>";

//output: 
//My New Text
//my other new text

?>
 

<!--
Note that this for some reason doesn't work.
<?php
$node = $nodes[0];
$nodes[0] = "My New Text";
?>
-->
