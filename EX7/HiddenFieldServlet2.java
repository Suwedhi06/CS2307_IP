import java.io.IOException;
import java.io.PrintWriter;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

@WebServlet("/HiddenFieldServlet2")
public class HiddenFieldServlet2 extends HttpServlet {

    protected void doGet(HttpServletRequest request,
            HttpServletResponse response)
            throws ServletException, IOException {

        String name = request.getParameter("hf");
        String password = request.getParameter("hp");

        response.setContentType("text/html");

        PrintWriter out = response.getWriter();

        out.println("<html>");
        out.println("<body>");

        out.println("<h2>Hello, " + name + "</h2>");

        out.println("<p>Password received successfully.</p>");

        out.println("<p>This value was passed using Hidden Form Fields.</p>");

        out.println("</body>");
        out.println("</html>");
    }
}