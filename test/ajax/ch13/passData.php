 <html>
  <head>
    <title>Passing data to functions</title>
  </head>

  <body>
    <h1>Passing data to functions</h1>

    <?
      echo "<h3>Welcome to my web page!</h3>";
      echo "<br>";
      echo "How do you like it?";
      echo "<br>";
      echo "<br>";

      $date = "2007";
      $holder = "PHP Masters, Inc.";

      print_copyright($date, $holder);

      function print_copyright($copyright_date, $copyright_holder)
      {
        echo "<hr>";
        echo "<center>";
        echo "&copy; $copyright_date $copyright_holder";
        echo "</center>";
      }
    ?>
  </body>
</html>