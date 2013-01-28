<html>
  <head>
    <title>
      Validating user input
    </title>
  </head>

  <body>
    <center>

      <h1>Validating user input</h1>
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

          if($_REQUEST["name"] == "") {
            $errors[] = "<font color='red'>Enter your  name</font>";
          }
        }

        function show_errors()
        {
          global $errors;

          foreach ($errors as $error){
            echo $error, "<br>";
          }
        }

        function handle_data()
        {
          echo "Your name is ";
          echo $_REQUEST["name"];
        }

        function display_welcome()
        {
           echo "<form method='post' action='validate.php'>";
           echo "Please enter your name";
           echo "<br>";
           echo "<input name='name' type='text'>";
           echo "<br>";
           echo "<br>";
           echo "<input type='submit' value='Submit'>";
           echo "<input type='hidden' name='already_shown' " , 
             "value='data'>";
           echo "</form>";
        }
      ?>

    </center>
  </body>
</html>
