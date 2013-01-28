<html>
    <head>
        <title>
          Putting everything in a single page
        </title>
    </head>

    <body>
        <center>
          <h1>Putting everything in a single page</h1>
          <?
            if(isset($_REQUEST["name"])){
          ?>
            Your name is
          <?
            echo $_REQUEST["name"];
            }
            else {
          ?>
            <form method="post" action="single.php">
                Enter your name:

                <input name="name" type="text">
                <br>
                <br>
                <input type="submit" value="Submit">
            </form>
          <?
            }
          ?>
        </center>
    </body>
</html>
