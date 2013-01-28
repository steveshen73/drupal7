<html>
        <head>
            <title>
                Copying an array
            </title>
        </head>

        <body>
            <h1>
                Copying an array
            </h1>

            <?
              $sandwiches[0] = "ham";
              $sandwiches[1] = "turkey";
              $sandwiches[2] = "roast beef";
              $sandwiches[2] = "egg";
              $sandwiches[] = "pastrami";
              $lunch = $sandwiches;
              echo $lunch[2];
            ?>
    </body>
</html>
