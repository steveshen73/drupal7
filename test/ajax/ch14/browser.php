<html>
  <head>
    <title>Finding browser type</title>
  </head>

  <body>
    <center>
        <h1>Finding browser type</h1>

        <br>
        <?
          if(strpos($_SERVER["HTTP_USER_AGENT"], "MSIE")){
            echo("<marquee><h1>Welcome to my page!</h1></marquee>");
          }
          else {
              echo("<h1>Please get Internet Explorer</h1>");
          }
        ?>
    </center>
  </body>
</html>
