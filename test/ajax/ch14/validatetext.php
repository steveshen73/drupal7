<html>
  <head>
    <title>Validating text</title>
  </head>

  <body>
    <center>
      <h1>Validating text</h1>

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

          if(!preg_match('/hello/i', $_REQUEST["text"])){
          $errors[] = "<font color='red'>Please include 'hello' " .
            "in your text.</font>";
          }
        }

        function show_errors()
        {
          global $errors;

          foreach ($errors as $err){
            echo $err, "<br>";
          }
        }

        function handle_data()
        {
          echo "You entered ";
          echo $_REQUEST["text"];
        }

        function display_welcome()
        {
          echo "<form method='post' 
            action='validatetext.php'>";
          echo "Please enter text including 'hello'";
          echo "<br>";
          echo "<input name='text' type='text'>";
          echo "<br>";
          echo "<br>";
          echo "<input type='submit' value='Submit'>";
          echo "<input type='hidden' name='already_shown' 
          value='hidden_data'>";
          echo "</form>";
        }
      ?>
    </center>
  </body>
</html>
