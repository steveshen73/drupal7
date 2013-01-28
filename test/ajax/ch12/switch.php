<html>
    <head>
        <title>
            Using the switch statement
        </title>
    </head>

    <body>
        <h1>
            Using the switch statement
        </h1>
        <?
          $temperature = 75;

          switch ($temperature){
            case 75:
              echo "Nice weather.";
              break;
            case 76:
              echo "Still nice weather.";
              break;
            case 77:
              echo "Getting warmer.";
              break;
            default:
              echo "Temperature outside the range.";
            }
        ?>
    </body>
</html>