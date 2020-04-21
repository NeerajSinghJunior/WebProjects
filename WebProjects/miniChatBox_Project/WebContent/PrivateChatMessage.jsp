<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.io.*,java.util.*" %>
<%@ page import="database.*,java.sql.*" %>  
<%@ page import="controller.coder.JsonEncoder" %>
<%! 
	String senderId="1",recId="4",M_ID,message,regex;
	Connection con;
	Statement stmt;
	ResultSet rs;
	
%>
<%
	senderId = request.getParameter("senderId");
	recId = request.getParameter("recId");
	//recId = "4";
	//senderId = "1";
	con = DataBaseConnection.getConnection();
	try {
		if (!con.isClosed()) {
			String query = "SELECT * FROM( SELECT * FROM `privatemessages` WHERE senderId=" + senderId
					+ " AND RecId=" + recId + " OR senderId=" + recId + " AND RecId=" + senderId
					+ " ORDER BY M_ID DESC LIMIT 20 ) AS a ORDER BY M_ID ASC";
			stmt = con.createStatement();
			rs = stmt.executeQuery(query);
			if(rs.isBeforeFirst()){
				JsonEncoder obj = new JsonEncoder();
				while (rs.next()) {
					M_ID =rs.getString("M_ID");
					senderId = rs.getString("senderId");
					recId = rs.getString("RecId");
					message = rs.getString("Message");
					obj.jsonObjectcreater("M_ID", M_ID);
					obj.jsonObjectcreater("senderId", senderId);
					obj.jsonObjectcreater("recId", recId);
					obj.jsonObjectcreater("message", message);
					obj.jsonObjectBuilder();
				}
				out.println(obj.jsonArrayBuilder());
			}
		}
	} catch (SQLException e) {
		e.printStackTrace();
	}
%>