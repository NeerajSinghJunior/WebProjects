<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<Title>TripHack</Title>
		<link href="css/style.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div id=header>TripHack</div>
		<div id="form_div">
			
			<center>
			<div id="form_header">Sign Up</div>
			<hr>
			<form id="form" method="get" action="SignUpServlet1">
				<input id="FirstName" name="FirstName"type="text" placeholder="First Name" autofocus="autofocus" required />
				<input id="MiddleName" placeholder="Middle Name" name="MiddleName" type="text"/>
				<input id="lastName" placeholder="Last Name" name="LastName" type="text"/>
				<input type="hidden" name="FormNo" value="1">
				<input type="submit" id="Next1" name="Next1" value="Next  &#8594"/>
				<br><br><x id="x"><a href=../login>Already Have an Account Click Here</a></x>
			</form></center>
			
		</div>
	</body>
</html>