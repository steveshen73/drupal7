<html>
    <head>
      <title>Using the foreach loop</title>
  </head>

    <body>
        <h1>Using the foreach loop</h1>
            <?
                $array = array("ham", "turkey", "tuna", "cheese");

                foreach ($array as $sandwich) {
                   echo "Current sandwich: $sandwich <br>";
               }
           ?>  
    </body>
</html>
