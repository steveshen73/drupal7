<html>
    <head>
        <title>
            Reading data from checkboxes
        </title>
    </head>

    <body>
        <center>
            <h1>Reading data from checkboxes</h1>

            You checked
            <?
                if (isset($_REQUEST["check1"]))
                    echo $_REQUEST["check1"], "<br>";
                if (isset($_REQUEST["check2"]))
                    echo $_REQUEST["check2"], "<br>";
            ?>
        </center>
    </body>
</html>
