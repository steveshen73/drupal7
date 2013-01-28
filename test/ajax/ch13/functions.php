<html>
  <head>
    <title>Using functions to create a copyright mark</title>
  </head>

  <body>
    <h1>Using functions to create a copyright mark</h1>

    <?
      echo "<h3>Welcome to my web page!</h3>";
      echo "<br>";
      echo "How do you like it?";
      echo "<br>";
      echo "<br>";

      print_copyright();

      function print_copyright()
      {
        echo "<hr>";
        echo "<center>";
        echo "&copy; 2007 PHP Masters, Inc.";
        echo "</center>";
      }
    ?>
  </body>
</html>