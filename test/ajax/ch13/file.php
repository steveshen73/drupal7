<html>
    <head>
        <title>Reading uploaded files</title>
    </head>

    <body>
        <center>
            <h1>Reading uploaded files</h1>
            <br>

            Here is what's in the file:
            <br>
            <br>
            <b>

            <?
                $handle = fopen($_FILES['userfile']['tmp_name'], 
                  "r");

                while (!feof($handle)){
                    $text = fgets($handle);
                    echo $text, "<BR>";
                }

                fclose($handle);
            ?>
            </b>
        </center>

    </body>
</html>
