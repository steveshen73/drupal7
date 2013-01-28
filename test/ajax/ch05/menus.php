<?
header("Content-type: text/xml");
if ($_POST["menu"] == "1")
  $menuitems = array('Ham', 'Turkey', 'Beef');
if ($_POST["menu"] == "2")
  $menuitems = array('Tomato', 'Cucumber', 'Rice');
echo '<?xml version="1.0" ?>';
echo '<menu>';
foreach ($menuitems as $value)
{
  echo '<menuitem>';
  echo $value;
  echo '</menuitem>';
}
echo '</menu>';
?>
