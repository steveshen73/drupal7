<html>
    <head>
        <title>
            Reading data from radio buttons
        </title>
    </head>

    <body>
        <center>
            <h1>Reading data from radio buttons</h1>

            You selected
            <?
                if (isset($_REQUEST["radio1"]))
                    echo $_REQUEST["radio1"], "<br>";
            ?>
        </center>
    </body>
</html>
