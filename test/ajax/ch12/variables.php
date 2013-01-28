<html>
    <head>
        <title>
            Using variables
        </title>
    </head>

    <body>
        <h1>
            Using variables
        </h1>

        <?
            echo "Setting number of sandwiches to 2.<br>";
            
            $sandwiches = 2;

            echo "Number of sandwiches: ", $sandwiches, "<br>";

            echo "Adding 2 more sandwiches.<BR>";

            $sandwiches = $sandwiches + 2;

            echo "Number of sandwiches now: ", $sandwiches, "<br>";
        ?>

    </body>

</html>
