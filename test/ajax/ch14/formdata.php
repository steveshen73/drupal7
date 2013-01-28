<html>
  <head>
    <title>
      Reading all form data
    </title>
  </head>

  <body>
    <center>
      <h1>Reading all form data</h1>

      Here is the form's data:
      <br>
      <?
        foreach($_REQUEST as $index => $value){
          if(is_array($value)){
            foreach($value as $item){
              echo $index, " => ", $item, "<br>";
            }
          }
          else {
            echo $index, " => ", $value, "<br>";
          }
        }
      ?>
      </center>
  </body>
</html>