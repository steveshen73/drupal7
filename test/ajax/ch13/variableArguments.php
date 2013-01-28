<html>
  <head>

    <title>
      Using variable-length argument lists
    </title>

  </head>

  <body>
    <h1>Using variable-length argument lists</h1>
            <?
    echo "combiner(No, problems) =  ", combiner("No", 
      "problems"), "<br>";

    echo "combiner(No, problems, here.) =  ", 
      combiner("No", "problems", "here."), "<br>";

    echo "combiner(No, problems, at, all.) =  ", 
      combiner("No", "problems", "at", "all."), "<br>";

    function combiner() 
    {
      $text_string = "";

      $arg_list = func_get_args();
            
      for ($loop_index = 0;$loop_index < func_num_args(); 
        $loop_index++) {
        $text_string .= $arg_list[$loop_index] . " ";
      }

      echo $text_string;
            } 
    ?>
  </body>
</html>
