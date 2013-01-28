<html>
    <head>
        <title>
            Using the if statement
        </title>
    </head>

    <body>
        <h1>
            Using the if statement
        </h1>
        <?
          $temperature = 85;

          if ($temperature < 80){
            echo "Not too hot.";
          }
          elseif ($temperature < 85) {
            echo "Still not too bad.";
          }
          elseif ($temperature < 90) {
            echo "Getting pretty hot.";
          }
          else {
            echo "Definitely too hot.";
          }
        ?>
    </body>
</html>
