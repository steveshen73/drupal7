<html>
    <head>
        <title>Reading image map data</title>
    </head>

    <body>
        <center>
            <h1>Reading image map data</h1>
            <br>
            You clicked the image map at (
            <?
                echo $_REQUEST["map_x"], ", ", $_REQUEST["map_y"];
            ?>
            ).
        </center>
    </body>
</html>
