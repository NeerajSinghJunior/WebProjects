package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DataBaseConnection implements DataBaseVariables {

	static Connection conn;
	public static Connection getConnection(){
		try {
			
			Class.forName("com.mysql.jdbc.Driver").newInstance();
			conn= DriverManager.getConnection(dbUrl,dbUserName,dbPassword);
		} catch (ClassNotFoundException | InstantiationException | IllegalAccessException | SQLException e) {
			e.printStackTrace();
		}
	return conn;
	}
}
