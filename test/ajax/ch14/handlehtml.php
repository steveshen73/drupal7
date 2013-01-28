<html>
  <head>
    <title>Handling HTML</title>
  </head>

  <body>
    <center>
      <h1>Handling HTML</h1>
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
          if($_REQUEST["comments"] == "") {
            $errors[] = "<font color='red'>Please enter your " . 
              "comments</font>";
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
          echo "Your comments were ";
          $ok_text = htmlentities($_REQUEST["comments"]);
          echo $ok_text;
        }

        function display_welcome()
        {
          echo "<form method='post' action='handlehtml.php'>";
          echo "Enter your comments<br>";
          echo "<input name='comments' type='text'>";
          echo "<br><br>";
          echo "<input type='submit' value='Submit'>";
          echo "<input type='hidden' name='already_shown' 
            value='hidden_data'>";
          echo "</form>";
        }
      ?>
     </center>
   </body>
</html>
