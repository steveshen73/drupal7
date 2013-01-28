<html>
    <head>
        <title>
            Using strings
        </title>
    </head>

    <body>
        <h1>
            Using strings
        </h1>

        <?
          echo trim("    I like PHP."), "<br>";

          echo substr("I like PHP.", 7, 3), "<br>";    

          echo "'PHP' starts at position ", strpos("I like PHP.", "PHP"), "<br>";

          echo "'I like PHP.' is ", strlen("I like PHP."), " characters long.<br>";

          echo substr_replace("I like PHP.", "love", 2, 4), "<br>";

          echo strtoupper("I like PHP."), "<br>";
        ?>

    </body>

</html>
