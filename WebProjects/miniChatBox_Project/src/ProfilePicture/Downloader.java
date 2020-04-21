package ProfilePicture;

import java.io.IOException;
import java.sql.Blob;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import database.DataBaseConnection;


@WebServlet("/downloader")
public class Downloader extends HttpServlet{

	private static final long serialVersionUID = 1L;

	@Override
	protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
		
		Connection con = DataBaseConnection.getConnection();
		try{
			if(!con.isClosed()){
				String query = "SELECT * from usertable where UserId=?";
				String g = req.getParameter("userId");
				PreparedStatement stmt = (PreparedStatement) con.prepareStatement(query);
				stmt.setString(1, g);
				ResultSet rs = stmt.executeQuery();
				while(rs.next()){
					Blob image =rs.getBlob("profilePhoto");
					if(image.length() == 0){
						resp.getWriter().print("ProfileImageNotSet");
					}
					else{
						byte[] imgData = image.getBytes(1, (int)image.length());
						resp.getOutputStream().write(imgData);
	 			}
				}
			}
		}catch(SQLException ex){
			ex.printStackTrace();
		}finally{
			if(con!=null){
				try{
					con.close();
				}catch(SQLException ex){
					ex.printStackTrace();
				}
			}
		}
		
	}
}
