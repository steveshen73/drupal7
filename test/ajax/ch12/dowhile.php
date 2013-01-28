<html>
    <head>
        <title>
            Using the do...while loop
        </title>
    </head>

    <body>
        <h1>
            Using the do...while loop
        </h1>
        <?
            $data = 1;

            do {
                echo "New data:", $data, "<br>";
                $data += 1;
            } while ($data < 8)
        ?>
    </body>
</html>
