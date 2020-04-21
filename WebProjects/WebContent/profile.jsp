<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.io.*,java.util.*" %>
<%@ page import="database.*,java.sql.*" %>  
<%! PreparedStatement stmt;
	String query,query2;
	String fromGrp;
%>  
<%
	if ( session.getAttribute("userId") == null ) {
		response.sendRedirect("./index.jsp");
	}
%>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title>Profile</title>
		<script type="text/javascript" src="./JS/jquery-2.1.4.js"></script>
		<style type="text/css">
			body{
				margin:0px;
				backgraound:#f5f5f5;
			}
            .FORM_CONTAINER{
                display: none;
                width: 100%;
                height: 100%;
                position: fixed;
                background: rgba(0,0,0,0.7);
                z-index: 200;
				top: 0 ;
            }
            .form_area{
                margin: auto;
                background:aliceblue;
                width: 730px;
    			padding: 5px;
            }
            .dropDiv{
                width: 100%;
                height: 211px;
                margin: auto;
                margin-top: 10px;
                border: 2px dashed black; 
                align-items: center;
				display: flex;
				justify-content: center;
				border-radius: 10px;
            }
            fieldset{
                width: 700px;
                height: 300px;
            }
			#dropDiv.hover
			{
				width: 100%;
                height: 211px;
				color: #f00;
				margin: auto;
                margin-top: 10px;
                border: 2px dashed #f00; 
                align-items: center;
				display: flex;
				justify-content: center;
				border-radius: 10px;
				box-shadow: inset 0 3px 4px #888;
			}
			.profie_container{
				width:100%;
				height:250px;
				//background:#000;
				border-bottom: 1px solid #222;
			}
			.profile_picture{
				margin:auto;
				border:1px solid #999;
				width:200px;
				height:200px;
				border-radius:50%;
				margin-top:100px;
				background-image:url("./Images/settings_profile.png");
				background-repeat: no-repeat;
    			 background-size: cover;
			}	
			
			 [contentEditable=true]:empty:not(:focus):before{
            	content:attr(data-text);
            	
            }
            [contentEditable=true]:focus {
            	content:attr(data-text);	
            }
            p{
            	margin:2px;
            }
            .upload_image{
            	height:200px;
            }
            .ChangedProfile{
            	width:inherit;
            	height:inherit;
            	border-radius:50%;
            }
            .closingButton{
            	width:50px;
            	height:50px;
            	font-size:60px;
            	float:right;
            	margin:20px;
            	cursor:pointer;
            }
            .formDiv{
            	clear:both;
           	    display: flex;
			    align-items: center;
			    height: 100%;
            }
            .disabled {
			    opacity: 0.6;
			    cursor: not-allowed;
			}
			.enable {
			    cursor: pointer;
			}
		</style>
		<script>
		var userId = '<%= session.getAttribute("userId")%>';
		window.addEventListener("load", profileupdate(userId));
			function profileupdate(e) {
					$(document).ready(function(){
					$.ajax({
						type : "get",
						url : "http://localhost:8080/minichat/downloader",
						data : "userId=" + e,
						success : function(ReturnData) {
							var im = $("#profile_picture").get(0);
							if (ReturnData == "ProfileImageNotSet") {
								im.src= "./Images/settings_profile.png";
							} else {
								im.src= "http://localhost:8080/minichat/downloader?userId="+e;
							}
						},
						error : function(e) {
							alert(e);
						}
					});
				});
			}
			function upload() {
				var a = $id("FORM_CONTAINER");
				a.style.display = "block";
				var fileselect = $id("INPUT_FILE"), dropDiv = $id("dropDiv"), submitbutton = $id("submitbutton");
				fileselect.addEventListener("change", FileSelectHandler, false);
				dropDiv.addEventListener("dragover", FileDragHover, false);
				dropDiv.addEventListener("dragleave", FileDragHover, false);
				dropDiv.addEventListener("drop", FileSelectHandler, false);
			}
			function FileDragHover(e) {
				e.stopPropagation();
				e.preventDefault();
				if (e.srcElement.id == "dropDiv") {
					e.target.className = (e.type == "dragover" ? "hover": "dropDiv");
				}
			}
			var imgSrc;
			function ParseFile(file) {
				if (file.type.indexOf("image") == 0) {
					var reader = new FileReader();
					reader.onload = function(e) {
						var m = $id("messages");
						m.innerHTML = "<p>File information: " + file.name + " Image Size : " + file.size / 1024;
						imgSrc = e.target.result;
						Output('<img class="upload_image" src="'+imgSrc+'"/>');
					}
					reader.readAsDataURL(file);
				} else {
					alert("The File should Be jpg/Jpeg");
				}
			}
			function Output(msg) {
				var m = $id("dropDiv");
				m.innerHTML = msg;
			}
			function $id(id) {
				return document.getElementById(id);
			}
			var sendFile;
			function FileSelectHandler(e) {
				FileDragHover(e);
				uploadButton.setAttribute("class","enable");
				var files = e.target.files || e.dataTransfer.files;
				var i = files.length;
				sendFile = files[i - 1];
				ParseFile(files[i - 1]);
			}
			function updatePhoto() {
				if (sendFile != null && sendFile.size <= 1048576 ) {
					var xhr = new XMLHttpRequest();
					var dataValue = new FormData();
					dataValue.append('photo', sendFile);

					if (xhr.upload && sendFile.type.indexOf("image") == 0) {
						$.ajax({
							url : 'uploadServlet',
							type : 'POST',
							dataType : 'json',
							mimeType : "multipart/form-data",
							contentType : false,
							cache : false,
							data : dataValue,
							processData : false,
							error : function(data) {
								console.log(data.responseText);
								if (data.responseText == "Multipart") {
									var im = $("#profile_picture").get(0);
									im.src= imgSrc;
									
									var a = document.getElementById("FORM_CONTAINER");
									a.style.display = "none";
								} else {
									alert("The File should Be jpg/Jpeg");
								}
							}
						});
					}
				} else {
					alert("Image Should be less than 1 MB");
				}
			}
			function closeForm(){
				var a = $id("FORM_CONTAINER");
				a.style.display = "none";
			}
		</script>
		
	</head>
	<body>
		<div class="profie_container">
			<div id="profile_picture_container" class="profile_picture">
				<img id="profile_picture" class="ChangedProfile" src="./Images/settings_profile.png"/>
			</div>
	        <div>
				<BUTTON class="uploadButton" onclick="upload()"> upload Photo</BUTTON>
			</div>
		</div>
		<DIV id="FORM_CONTAINER" CLASS="FORM_CONTAINER">
		<div><div class="closingButton" onclick="closeForm()">&#10006;</div></div>
		<div class="formDiv">
			<div id="formDATA" class="form_area">
					<fieldset>
						<legend>HTML File Upload</legend>
						<INPUT TYPE="FILE" ID="INPUT_FILE"  name="photo"/>
		
						<div class="dropDiv" id="dropDiv" >
	                        or drop files here
	                    </div>
						<div id="messages">
							<p>Status Messages</p>
						</div>
						<button id="uploadButton" class="disabled" onclick="updatePhoto()">Change Profile Photo</button>
					</fieldset>
				</div>
			</DIV>
		</div>
	</body>
</html>