<%@ page import="java.security.MessageDigest" %>

<html>
  <head>
    <title>
      Using public and private keys
    </title>
  </head>

  <body>

    <%
      String browserString = request.getParameter("data");

      String serverString = new String("");

      byte[] bytes = {0, 0, 0};

      try
      {
        MessageDigest md = MessageDigest.getInstance("MD5");

        bytes = md.digest("test".getBytes());
      }

      catch(Exception ex)
      {
        out.println("Error.");
      }

      for (int loopIndex = 0; loopIndex < bytes.length; loopIndex++){
        byte b  = bytes[loopIndex];

        Integer i = new Integer(b);

        String s = Integer.toHexString(i.intValue());

        if(java.lang.Math.abs(i.intValue()) < 10){
          s = "0" + s;
        }

        if(s.indexOf("ffffff") >= 0){
          s = s.substring(6);
        }

        serverString += s;
      }

   
      if(browserString.equals(serverString)){
        out.println("You're in.");
      }
      else {
        out.println("No go.");
      }
    %>
  </body>
</html>
