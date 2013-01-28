<% 
  if(request.getParameter("password").equals("opensesame")){
    out.println("You're in.");
  }
  else {
    out.println("Wrong password");
  }
%>