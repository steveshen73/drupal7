<html>
    <head>
        <title>Using Lists</title>
    </head>

    <body>
        <center>
            <h1>Retrieving Data From Lists</h1>
            You selected:
            <br>
            <?
            foreach($_REQUEST["sandwiches"] as $sandwich){
                echo $sandwich, "<BR>";
            }
            ?>
        </center>
    </body>
</html>
