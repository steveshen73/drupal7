<html>
  <head>
    <title>Validating integers</title>
  </head>

  <body>
    <center>

      <h1>Validating integers</h1>

      <?
        $errors = array();
        if(isset($_REQUEST["already_shown"])){
          validate_data();

          if(count($errors) != 0){
            show_errors();
            display_welcome();
          } 
          else {
            handle_data();
          }
        } 
        else {
          display_welcome();
        }

        function validate_data()
        {
          global $errors;
          if(strcmp($_REQUEST["number"], 
            strval(intval($_REQUEST["number"])))) {
            $errors[] = "<font color='red'>Please enter an 
            integer</font>";
          }
        }

        function show_errors()
        {
          global $errors;

          foreach ($errors as $err){
            echo $err, "<BR>";
          }
        }

        function handle_data()
        {
          echo "You entered ";
          echo $_REQUEST["number"];
        }

        function display_welcome()
        {
          echo "<form method='post' action='validateinteger.php'>";
          echo "Please enter an integer.";
          echo "<br>";
          echo "<input name='number' type='text'>";
          echo "<br>";
          echo "<br>";

          echo "<input type='submit' value='Submit'>";
          echo "<input type='hidden' name='already_shown' " .
            "value='data'>";
          echo "</form>";
        }
      ?>
    </center>
  </body>
</html>
