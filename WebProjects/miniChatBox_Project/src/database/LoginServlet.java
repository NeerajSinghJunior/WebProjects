package database;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

@WebServlet("/LoginServlet")
public class LoginServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	@Override
	protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

		HttpSession session = req.getSession();
		Connection con = DataBaseConnection.getConnection();	

		try{	
			if(!con.isClosed()){
				String userName = req.getParameter("userName");
				String Password = req.getParameter("password");

				String query = "SELECT * from usertable where UserName=? OR Email=? AND BINARY Password=?";
				PreparedStatement stmt = (PreparedStatement) con.prepareStatement(query);
				stmt.setString(1, userName);
				stmt.setString(2, userName);
				stmt.setString(3, Password);
				ResultSet result = stmt.executeQuery();
				if(result.isBeforeFirst()){
					while(result.next()){
						String userId = result.getString("userId");
						String FirstName = result.getString("FirstName");
						session.setAttribute("userId",userId);
						session.setAttribute("FirstName",FirstName);
						resp.getWriter().append("1");
						System.out.print("1");
						resp.sendRedirect("./chat.jsp");
					}
				}else{
					System.out.print("2");
					resp.getWriter().append("2");
				}
			}
		}catch(SQLException e){
			e.printStackTrace();
		}

	}

}
