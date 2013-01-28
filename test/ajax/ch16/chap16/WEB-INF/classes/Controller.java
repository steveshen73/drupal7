import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import beans.Model;

public class Controller extends HttpServlet 
{
    String target = "view.jsp";

    Model model = new Model();

    public void doGet(HttpServletRequest request, HttpServletResponse response) 
        throws ServletException, IOException 
    {
        request.setAttribute("message", model.msg());
        RequestDispatcher dispatcher = 
            request.getRequestDispatcher(target);
        dispatcher.forward(request, response);
    } 
}