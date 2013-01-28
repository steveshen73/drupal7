<?php 
  require("libajax.php"); 

  function adder($operand1, $operand2) 
  { 
    print $operand1 + $operand2; 
  } 

  $ajax = new Ajax(); 
  $ajax->mode = "GET"; 
  $ajax->export = array("adder");
  $ajax->client_request(); 
?>
<html> 
  <head> 
    <title>Using the LibAjax server-side framework</title> 
    <script> 

      <?php 
        $ajax->output(); 
      ?> 

      function display(result) 
      { 
        document.getElementById("result").value = result; 
      }

      function useLibAjax() 
      {
        var operand1 = document.getElementById("operand1").value; 
        var operand2 = document.getElementById("operand2").value; 
        ajax_adder(operand1, operand2, display);
      }
    </script> 

  </head>

  <body>
    <center>
      <h1>Using the LibAjax server-side framework</h1>
      <form>
        <input type="text" name="operand1" id="operand1" value="4" 
          size="5">
        +
        <input type="text" name="operand2" id="operand2" value="5" 
          size="5"> 
        =
        <input type="text" name="result" id="result" value="" size="5">
        <input type="button" name="check" value="Add" 
          onclick="useLibAjax()">
      </form>
    </center>
  </body>
</html>


