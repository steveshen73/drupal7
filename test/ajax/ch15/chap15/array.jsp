<%
  String[] array = {"tic", "tac", "toe"};

  int index = Integer.parseInt(request.getParameter("index"));

  if(index < 0 || index > array.length){

    out.println("Sorry, that array element is out of bounds.");

  }
  else {

    out.println("The array element is ");
 
    out.println(array[index]);
  }
%>