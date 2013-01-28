<?
  require("Sajax.php");
	
  function adder($operand1, $operand2) 
  {
    return $operand1 + $operand2;
  }
	
  sajax_init();
  sajax_export("adder");
  sajax_handle_client_request();
	
?>
<html>
  <head>
    <title>Using the Sajax server-side framework</title>
    <script>
      <?
        sajax_show_javascript();
      ?>
	
      function show_results(result) 
      {
        document.getElementById("result").value = result;
      }
	
      function do_adder() 
      {
        var operand1, operand2;
	
        operand1 = document.getElementById("operand1").value;
        operand2 = document.getElementById("operand2").value;
        x_adder(operand1, operand2, show_results);
      }
    </script>
	
  </head>

  <body>
    <center>
      <h1>Using the Sajax server-side framework</h1>  
      <input type="text" name="operand1" id="operand1" value="4" size="3">
	  +
      <input type="text" name="operand2" id="operand2" value="5" size="3">
        =
      <input type="text" name="result" id="result" value="" size="3">
      <input type="button" name="check" value="Add"
        onclick="do_adder(); return false;">
    </center>
  </body>
</html>
