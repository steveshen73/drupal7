<%@ page import="java.security.*" %>

<% 
  Principal principal = request.getUserPrincipal();
  out.println("Your username is: " + principal.getName());
%>