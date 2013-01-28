<html>
  <head>
    <title>
      Reading form data in arrays
    </title>
  </head>

  <body>
    <center>
      <h1>Reading form data in arrays</h1>

      Your name is
      <?
        $data = $_REQUEST['data'];
        echo $data['name'], "<br>";
       ?>

       Your age is
       <?
         $data = $_REQUEST['data'];
         echo $data['age'], "<br>";
       ?>
     </center>

   </body>
</html>
