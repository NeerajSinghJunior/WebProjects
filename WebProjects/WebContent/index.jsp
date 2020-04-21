<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.io.*,java.util.*" %>    
<%@ page import="database.*,java.sql.*" %>
<%! PreparedStatement stmt;
	String query,query2;
%>
    
<%
	if ( session.getAttribute("userId") != null ) {
		response.sendRedirect("./chat.jsp");
	}
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Chat DataBase</title>
		<script type="text/javascript" src="./JS/jquery-2.1.4.js"></script>
		<style type="text/css">
			body{
				background:#f1f3f5;
			}
			#formDiv
			{
				margin-top:80px;
				width:250px;
				height:450px;
				margin-left:auto;
				margin-right:auto;
				background:#fcfcfc;
				border: 5px solid #b2b2b2;
				border-radius:20px;
				padding-left:50px;
				padding-right:50px;
			}
			#form{
				width:250px;
				height:350px;
				margin-top:20px;
			}
			
			#form_header{
				width:100px;
				height:50px;
				text-align:center;
				font-size:40px;
				color:#c3c52c;
				margin-top:35px;
				
			}
			
			input
			{
				width:250px;
				height:50px;
				border:3px solid #g6g6g6;
				border-radius:5px;
				padding:2px;
				margin-bottom:5px;
				text-align:center;
				font-size:30px;
				
			}
			header{
				color:#7264b7;
				font-size:42px;
				margin:10px 25px;
				text-decoration: underline;
			}
			footer{
				position: absolute;
				bottom:10px;
				margin-left:10px;
			}
		</style>
	</head>
	<body>
		
		<style>
			#notification {margin-left: auto; margin-right: auto;  margin-top: 6%; font-family: 'Montserrat', sans-serif; color: #ff3232; font-size: 1.2em;
							text-align: center;transition: opacity 1s ease-out;opacity: 1;}
		</style>
		<header>
			Mini-Chat
		</header>
		<div id="container">
			<div id="formDiv">
				<center>
					<div id="form_header">Login</div>
					<%
						if(request.getParameter("submit") != null){
							Connection con = DataBaseConnection.getConnection();	
							try{	
								if(!con.isClosed()){
									String userName = request.getParameter("userName");
									String Password = request.getParameter("password");

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
											response.sendRedirect("./chat.jsp");
										}
									}else{
										out.println("Incorrect Password Or UserName");
									}
								}
							}catch(SQLException e){
								e.printStackTrace();
							}		
						}
					%>

					<form id="form" action="index.jsp" method="post">
						<div id="notification"></div>
						<input type="text" id="userName" name="userName" placeholder="Enter UserName" autofocus>
						<input type="password" id="password" name="password" placeholder="Enter Password" >
						<input id="submit" name="submit" type="submit" value="LogIn">
						<br><br><x id="x"><a href="./SignUp.jsp">Don't Have an Then Click Here</a></x> 
					</form>
				</center>
				
			</div>
		</div>
		<footer>Developed & Managed by <u>Nitin Sharma</u> </footer>
	</body>
</html>