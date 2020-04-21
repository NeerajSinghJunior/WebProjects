<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.io.*,java.util.*" %>    
<%@ page import="database.*,java.sql.*" %>
<%! PreparedStatement stmt;
	String query,query2;
%>
<%
	if ( session.getAttribute("userId") != null ) {
		response.sendRedirect("./index.jsp");
	}
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<Title>Sign Up</Title>
		<link href="css/style.css" type="text/css" rel="stylesheet">
		<style>
			header{
				color:#7264b7;
				font-size:42px;
				margin:10px 25px;
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<header>
			Mini-Chat
		</header>
		<div id="form_div" style="width:420px;height:626px; margin-top:30px;">
			<center>
				<div id="form_header" >Sign Up</div>
				<hr>
			<%
				if(request.getParameter("submit") != null){
					String FirstName = request.getParameter("FirstName");
					String LastName = request.getParameter("LastName");
					String UserName = request.getParameter("UserName");
					String Email = request.getParameter("Email");
					String Password = request.getParameter("Password");
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
										+ " VALUES (?,?,?,?,?,?)";
								stmt = (PreparedStatement) con.prepareStatement(query2);
								stmt.setString(1, null);
								stmt.setString(2, FirstName);
								stmt.setString(3,LastName);
								stmt.setString(4,UserName);
								stmt.setString(5,Email);
								stmt.setString(6,null);
								stmt.setString(7,Password);
								
								int row = stmt.executeUpdate();
								if(row > 0){
									System.out.println("file upload and saved to database");
								}
							}

						}
					}catch(SQLException e){
						e.printStackTrace();
					}

				}
			%>
		
				<form  method="post" action="SignUp.jsp">
					<input id="FirstName" name="FirstName"type="text" placeholder="First Name" autofocus="autofocus" required />
					<input id="lastName" placeholder="Last Name" name="LastName" type="text"/>
					<input id="UserName" type="text" name="UserName" placeholder="UserName" required/>
					<input id="Email" type="Email" name="Email" placeholder="Email Address" required/>
					<input id="Password" placeholder="Password" name="Password" type="password" required/>
					<input type="submit" id="submit" name="submit" value="submit  &#8594"/>
					<br><br><x id="x"><a href=./>Already Have an Account Click Here</a></x>
				</form>
			</center>
		</div>
		<script>
</script>
	</body>
</html>