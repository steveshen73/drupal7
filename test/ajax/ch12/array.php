<html>
        <head>
            <title>
                Displaying an array
            </title>
        </head>

        <body>
            <h1>
                Displaying an array
            </h1>

        <?
            $sandwiches[0] = "ham";
            $sandwiches[1] = "turkey";
            $sandwiches[2] = "roast beef";

            $sandwiches[2] = "egg";

            $sandwiches[] = "pastrami";

            for ($index = 0; $index < count($sandwiches); $index++){
                echo $sandwiches[$index], "<br>";
            }
        ?>
    </body>
</html>
