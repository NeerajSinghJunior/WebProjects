package ProfilePicture;

import java.io.IOException;
import java.io.InputStream;
import java.sql.DriverManager;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.MultipartConfig;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;
import javax.servlet.http.Part;

import com.mysql.jdbc.Connection;
import com.mysql.jdbc.PreparedStatement;

import database.DataBaseConnection;



@WebServlet("/uploadServlet")
@MultipartConfig(maxFileSize = 16177215)

public class Uploader extends HttpServlet{

	private static final long serialVersionUID = 1L;
	
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException{
		InputStream inputStream = null;
		HttpSession session = request.getSession();
		Part filePart  = request.getPart("photo");
		
		if(filePart !=null ){
			System.out.println(filePart );
			System.out.println(filePart.getName());
			System.out.println(filePart.getSize());
			System.out.println(filePart.getContentType());
			
			inputStream = filePart.getInputStream();
			
		}else{
			response.getWriter().append("not Multipart");
		}
		String message = null;
		Connection conn = (Connection) DataBaseConnection.getConnection();	

		try{	
			if(!conn.isClosed()){
				String sql = "update usertable set profilePhoto=? where userId=?";
				
				PreparedStatement statement = (PreparedStatement) conn.prepareStatement(sql);
				if(inputStream != null){
					statement.setBlob(1, inputStream);
					statement.setString(2,(String) session.getAttribute("userId") );
				}
				int row = statement.executeUpdate();
				if(row > 0){
					response.getWriter().append("Multipart");
				}
			}
		}catch(SQLException ex){
			response.getWriter().append("ERROR : " +ex.getMessage());
		} finally{
			if(conn!=null){
				try{
					conn.close();
				}catch(SQLException ex){
					ex.printStackTrace();
				}
			}
		}
	}
}