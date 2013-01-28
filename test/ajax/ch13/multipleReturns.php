<html>
  <head>
    <title>
      Returning multiple values from functions
    </title>
  </head>

  <body>
    <h1>
      Returning multiple values from functions
    </h1>

    <?
            
      list($first, $second, $third, $fourth, $fifth, 
        $sixth) = returner();

      echo "\$first: $first<BR>";
      echo "\$second: $second<BR>";
      echo "\$third: $third<BR>";
      echo "\$fourth: $fourth<BR>";
      echo "\$fifth: $fifth<BR>";
      echo "\$sixth: $sixth<BR>";
    
      function returner()
      {
        $array = array("Red", "Green", "Yellow", "Blue", 
          "Orange", "Magenta");

        return $array;
      }
    ?> 
  </body>
</html>