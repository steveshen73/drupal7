<html>
  <head>

    <title>
      Returning values from functions
    </title>

  </head>

  <body>
    <h1>Returning values from functions</h1>
    <?
      echo "adder(3, 2) = ", adder(3, 2), "<br>";

      echo "adder(5, 7) = ", adder(5, 7), "<br>";

      echo "adder(9, 17) = ", adder(9, 17), "<br>";


      function adder($operand_1, $operand_2) 
      {
        return $operand_1 + $operand_2;
      } 
    ?>
  </body>
</html>
