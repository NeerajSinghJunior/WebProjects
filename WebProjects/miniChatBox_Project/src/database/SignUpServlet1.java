package database;

import java.io.IOException;
import java.io.InputStream;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.Part;

@WebServlet("/SignUpServlet1")
@MultipartConfig(maxFileSize = 16177215)

public class SignUpServlet1 extends HttpServlet {

	private static final long serialVersionUID = 1L;

	PreparedStatement stmt;
	String query,query2;

	@Override
	protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		String cont = req.getContentType();
		System.out.println(cont);
		
		PrintWriter out = resp.getWriter(); 
		
		String FirstName = req.getParameter("FirstName");
		String LastName = req.getParameter("LastName");
		String UserName = req.getParameter("UserName");
		String Email = req.getParameter("Email");
		String Password = req.getParameter("Password");

		InputStream inputStream = null;
		Part filePart  = req.getPart("photo");
		
		if(filePart !=null){
			inputStream = filePart.getInputStream();
		}

		Connection con = DataBaseConnection.getConnection();	

		try{	
			if(!con.isClosed()){
				query = "SELECT * from usertable where UserName=? OR Email=?";
				stmt = (PreparedStatement) con.prepareStatement(query);
				stmt.setString(1, UserName);
				stmt.setString(2, Email);

				ResultSet result = stmt.executeQuery();

				if(result.isBeforeFirst()){
					while(result.next()){
						String userName = result.getString("UserName");
						if(userName.equals(UserName)){
							out.println("UserName Alreay Existed use Another UserName");
						}else{
							out.println("Email is Already Exited use Different Email");
						}
					}
				}else{
					query2 = "INSERT INTO usertable"
							+ " VALUES (?,?,?,?,?,?,?)";
					stmt = (PreparedStatement) con.prepareStatement(query2);
					stmt.setString(1, null);
					stmt.setString(2, FirstName);
					stmt.setString(3,LastName);
					stmt.setString(4,UserName);
					stmt.setString(5,Email);
					if(inputStream != null){
						stmt.setBlob(6, inputStream);
					}
					stmt.setString(7,Password);
					

					int row = stmt.executeUpdate();
					if(row > 0){
						System.out.println("file upload and saved to database");
						resp.sendRedirect("./index.jsp");
					}
				}

			}
		}catch(SQLException e){
			e.printStackTrace();
		}

	}
}


