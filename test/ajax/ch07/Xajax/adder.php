<?php
  require("xajax.inc.php");

  function adder($operand1, $operand2)
  {
    $response = new xajaxResponse();
    $response->addAssign("result", "value", $operand1 + $operand2);
    return $response->getXML();
  }

  $xajax = new xajax();
  $xajax->registerFunction("adder");
  $xajax->processRequests();

?>
<html> 
  <head>
    <title>Using the Xajax server-side framework</title> 
    <?php 
      $xajax->printJavascript(); 
    ?> 
    <script>
      function useXajax()
      {
        xajax_adder(document.getElementById('operand1').value,
          document.getElementById('operand2').value);
      }
    </script>
  </head> 

  <body>
    <center> 
      <h1>Using the Xajax server-side framework</h1>
      <input type="text" name="operand1" id="operand1" value="4" size="3" /> 
      +
      <input type="text" name="operand2" id="operand2" value="5" size="3" /> 
      =
      <input type="text" name="result" id="result" value="" size="3" /> 
      <input type="button" value="Add" 
      onclick="useXajax();return false;" />
	</body> 
</html>
