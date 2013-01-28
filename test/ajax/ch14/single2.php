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
            if(isset($_REQUEST["already_shown"])){
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
                <input name="already_shown" type="hidden" value="data">
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
