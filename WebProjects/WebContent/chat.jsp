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
		<title>Chat</title>
        <script type="text/javascript" src="./JS/jquery-2.1.4.js"></script>
        <link href="css/style_chat.css" rel=stylesheet>
        <script type="text/javascript">
			var userId = '<%= session.getAttribute("userId")%>';
			var userName = '<%= session.getAttribute("FirstName")%>';
			var fromGrp,msgGrp,msgId;
			var websocket = new WebSocket("ws://localhost:8080/minichat/ChatServerEndpoint?userName="+userName+"&userId="+userId);
						
			var NumPop = [];
			var total_popups;
			var dis = 0;
			websocket.onmessage = function processMessage(message){
				//alert(message.data);
				var obj = JSON.parse(message.data);

				switch (obj.action) {
					case "ONLINEUSERS":
						OnlineUsers(obj);
						break;
					case "GROUP":
						var msg = obj.message;
						var from = obj.from;
							$("#TextRow_Group").append('<div class="GroupChatPop">'
										+'<div class="GroupRecText"> <span style="color:blue;font-weight:bold;">'+$("#"+from).text()+'</span><br>&nbsp&nbsp'+msg.trim()+'</div></div>');
							Text_Group.scrollTop = Text_Group.scrollHeight - Text_Group.clientHeight;
						break;
					case "PRIVATE":
						msg = obj.message;
						from  = obj.from;
						var b = document.getElementById(from);
						privateBox(b);
						var textArea = "PreTextRow_"+from;
						$("#"+textArea).append('<div class="PrivateChatPop">'
								+'<div class="privateRecText">'+msg.trim()+'</div></div>');
						var scrlTo ="PreText_"+from;
						scrlTo = document.getElementById(scrlTo);
						scrlTo.scrollTop = scrlTo.scrollHeight - scrlTo.clientHeight;
						break;
					default:
						alert("other");
				}
			}

			function OnlineUsers(e) {
				var i, n;
				var a = document.getElementById("listContainer");
				a.innerHTML = "";
				var LIST = Object.keys(e.onlineUsers);
				for (i = 0; i < LIST.length; i++) {
					var b = document.createElement('div');
					if(LIST[i] != this.userId){
						$("#listContainer").append('<div id='+LIST[i]+' class="userList" onclick="privateBox(this)">'
								+'<div class="userListImage"><img class="userImage" id=UserImage_'+LIST[i]+' src="./Images/settings_profile.png"></img></div>'
								+'<div class="userListName">'+e.onlineUsers[LIST[i]]+'</div>'
						+'</div>');
						profileupdate(LIST[i]);
					}else{
						MyUserName.setAttribute("ref_id",LIST[i]);
						MyUserName.innerHTML = '<div  class="userheaderImage"><img class="userPrImage" id=UserImage_'+LIST[i]+' src="./Images/settings_profile.png"></img></div><div class="userName" id='+LIST[i]+'>'+e.onlineUsers[LIST[i]]+'</div>';
						profileupdate(LIST[i]);
					}
				}
			}
			function profileupdate(e){
				var im = $("#UserImage_"+e).get(0);
				$.ajax({
	   				type : "get",
	   				url : "http://localhost:8080/minichat/downloader",
	   				data:"userId="+e,
	   				success : function(ReturnData){
	   					if(ReturnData == "ProfileImageNotSet"){
	   						im.src= "./Images/settings_profile.png";
	   					}else{
	   						im.src ="http://localhost:8080/minichat/downloader?userId="+e;
	   					}
	   				},
	   				error : function(e){
	   					alert(e);
	   				}
	   			});
			}
			function SendMessageToServer(e){
				websocket.send(e);
			}
			function Private(e,Msg){				
				var to = e;
				var msg = Msg.trim();
				var message  = {"action":"PRIVATE","to": to,"message":msg};
				message = JSON.stringify(message);
				SendMessageToServer(message)
			}
			function GroupExchager(e){
				var msg = e;
				var message  = {"action":"GROUP","message":msg};
				message = JSON.stringify(message);
				SendMessageToServer(message)
			}
			function requestRefreshOnlineUserList(){
				var message  = {"action":"ONLINEUSERS"};
				message = JSON.stringify(message);
				SendMessageToServer(message)
			}
			var i,prev=null;
            var privateBox = function(e){
            	if(e.id != this.userId){
            		var bol = checkVisiblity(e);
            		checkInList();
	                
            		if(bol != undefined){
            			if(bol == "already"){
            				var a = $("#ModB_"+e.id);
            				var b;
		                    b = a.get(0);
		                    a.show();
		                    
            			}else{
            				var a = $(bol);
		                    a = $(a);
		                    var b;
		                    b = a.get(0);
		                    dis = dis +255;
		                    b.style.right = dis+"px";
		                    b.setAttribute("active","1");
		                    a.fadeIn();
		                    NumPop.push(a);
            			}
	                }else{
	                    createPrivate(e);
	                }
	            }
            }
            var checkInList = function(){
            	if(NumPop.length >= total_popups){
            		NumPop[0].hide();
            		NumPop.shift();
            		dis = dis - 255;
        		}
            }
            var preHide = function(e){
            	var userId = e.getAttribute('ref_id');
            	var chng,pos,rm,strt;
            	$("#ModB_"+userId).fadeOut();
            	chng = $("#ModB_"+userId).get(0);
            	
            	chng.removeAttribute("active")
            	dis = dis - 255;
            	
            	for(var i=0;i<NumPop.length;i++){
            		if(strt === 1){
            			chng = NumPop[i].get(0);
	            		pos = chng.style.right;
	            		pos = parseInt(pos);
	            		pos = pos - 255;
	            		chng.style.right = pos+"px";
            		}
            		if(NumPop[i].get(0) === chng){
            			strt = 1;
            		}
            	}
            	NumPop.shift();
            	if(NumPop.length == 0){
            	dis=0;
            	}
            }
            
            var checkVisiblity = function(e){
                var a = $("#ModB_"+e.id).attr("ref_id");
                var cond = $("#ModB_"+e.id).attr("active");
                
                if(a === e.id){
                    
                    if(cond === "1" ){
                    	return "already";
                    }else{
                    	return "#ModB_"+e.id;
                    }
                }
            }
            
            var createPrivate = function(e){
	
                $('body')
                        .append('<div id=ModB_'+e.id+' ref_id='+e.id+' class="PrivateChatBox">'
                                    +'<div class="PrivateBoxHeader">'
                                        +'<div class="userImg"><img src='+$('#UserImage_'+e.id).attr('src')+'></img></div>'
                                        +'<div class="PrivateUserHeaderName">'+e.innerText+'</div>'
                                        +'<span><div class="ChatClosingButton" ref_id='+e.id+' onclick="preHide(this)">&#10006</div></span>'
                                    +'</div>'
                                    +'<div class="PrivateChatArea">'
                                        +'<div id=PreText_'+e.id+' class="PrivateChatText"><div class="PreTextRow" id=PreTextRow_'+e.id+'></div></div>'
                                        +'<div id=Input_'+e.id+' ref_id='+e.id+' data-text="Enter Message Here." contentEditable=true class="PrivateChatInput" onclick="InputPrivate(this)"></div>'
                                    +'</div>'
                                +'</div>');
                var  a = $("#ModB_"+e.id);
                NumPop.push(a);
                a = a.get(0);
                dis = dis + 255;
                a.setAttribute("active","1");
                a.style.right = dis+"px";
                privateChatMessage(e);
            }
            function privateChatMessage(e){
            	var recId = e.id;
            	$.ajax({
	   				type : "get",
	   				url : "http://localhost:8080/minichat/PrivateChatMessage.jsp",
	   				data:"senderId=<%=(String)session.getAttribute("userId")%>&recId="+recId,
	   				success : function(ReturnData){
	   					var obj2,i;
	   					var obj = JSON.parse(ReturnData);
	   					var len = obj.length;
	   					for(i=0;i<len;i++){
	   						obj2 = JSON.parse(obj[i]);
	   						console.log(obj2.message);
	   						if(obj2.senderId === e.id){
							var textArea = "PreTextRow_"+e.id;
								$("#"+textArea).append('<div class="PrivateChatPop">'
										+'<div class="privateRecText">'+obj2.message.trim()+'</div></div>');
	   						}else{
	   							$("#"+textArea).append('<div class="PrivateChatPop"><div class="privateSendText">'+obj2.message.trim()+'</div></div>');
	   						}
	   						var scrlTo ="PreText_"+e.id;
							scrlTo = document.getElementById(scrlTo);
							scrlTo.scrollTop = scrlTo.scrollHeight - scrlTo.clientHeight;
	   					}
	   				},
	   				error : function(e){
	   					alert(e);
	   				}
	   			});
            	
            }
            var InputPrivate = function(e){
            	var a = e.id;
            	var b = document.getElementById(a);
            	var userL = b.getAttribute('ref_id');
            	var textArea = "PreTextRow_"+userL;
            	var c = "Input_"+userL;
				c = document.getElementById(c);
				
            	$("#"+a).keypress(function(event){
                    if(event.which === 13 || event.keyCode === 13){
                    	event.preventDefault();
                    	if(c.innerText.length != 0){
                    		$("#"+textArea).append('<div class="PrivateChatPop"><div class="privateSendText">'+e.innerText.trim()+'</div></div>');
							Private(userL,e.innerText.toString());
							c.innerText = '';
							
							var scrlTo ="PreText_"+userL;
		    				scrlTo = document.getElementById(scrlTo);
		    				scrlTo.scrollTop = scrlTo.scrollHeight - scrlTo.clientHeight;
                    	}
                    }
                 });
            	
            }
            var InputGroup = function(e){
            	
            	$("#GroupInput").keypress(function(event){
                    if(event.which === 13 || event.keyCode === 13){
                    	event.preventDefault();
                    	if(e.innerText.length != 0){
                    		//$("#TextRow_Group").append('<div class="GroupChatText"><div class="GroupSendText">'+e.innerText.trim()+'</div></div>');
							GroupExchager(e.innerText.toString());
							e.innerText = '';
                    	}
                    }
                 });
            }
            function calculate_popups()
            {
                var windowWidth = window.innerWidth;
                if(windowWidth < 540)
                {
                    total_popups = 0;
                }
                else
                {
                	windowWidth = windowWidth - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(windowWidth/255);
                }
                //display_popups();
                $(document).ready(function(){
                <%
                Connection con = DataBaseConnection.getConnection();	
                if(!con.isClosed()){
                	String query = "SELECT * FROM (SELECT * FROM `usertable`,`groupmessage` WHERE userId = groupmessage.From ORDER BY M_ID DESC LIMIT 20 ) AS a ORDER BY M_ID ASC";
                	PreparedStatement stmt = (PreparedStatement) con.prepareStatement(query);
                	ResultSet result = stmt.executeQuery();
    				if(result.isBeforeFirst()){
    					while(result.next()){%>
    						fromGrp = '<%=result.getString("FirstName")%>';
    						msgGrp = '<%=result.getString("Message")%>';
    						msgId = '<%=result.getString("M_ID")%>';
    						$("#TextRow_Group").append('<div id='+msgId+' class="GroupChatPop">'
    								+'<div class="GroupRecText"> <span style="color:blue;font-weight:bold;">'+fromGrp+'</span><br>&nbsp&nbsp'+msgGrp.trim()+'</div></div>');
    						Text_Group.scrollTop = Text_Group.scrollHeight - Text_Group.clientHeight;
    						<%
    					}
    				}    				
                }
                %>
                });
            }
            
            function display_popups(){
            	var num = total_popups;
            	var right = 255;
            	var i;
            	calculate_popups();
            	for(i;i<total_popups;i++){
            		if(NumPop[i] != undefined)
                    {
	            		var element  = document.getElementsByClassName("PrivateChatBox")
	                    element.style.right = right + "px";
	                    right = right + 255;
	                    element.style.display = "block";
                    }
            	}
            	for(var jjj = i; jjj < total_popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            window.addEventListener("resize", display_popups);
            window.addEventListener("load", calculate_popups);
            
		</script>
    </head>
	<body>
		<header>
			<div id="ChatName" class="ChatName" >MiniChat</div>
			<!-- <div id="LogOut" class="LogOut" onclick="logout()">Sign-Out</div> -->
			<div id="MyUserName" class="MyUserName"></div>
		</header>
		
		<div id="GroupChat" class="GroupChat">
			<div id="ModB_Group" class="GroupChatBox">
				<div class="GroupBoxHeader">
					<div class="GroupuserImg">
						<img src="./Images/groups.png"> </img>
					</div>
					<div class="GroupHeaderName">Group Chat</div>
				</div>
				<div class="GroupChatArea">
					<div id="Text_Group" class="GroupChatText">
						<div class="GroupTextRow" id="TextRow_Group"></div>
					</div>
					<div id="GroupInput" data-text="Enter Message Here." contentEditable=true class="GroupChatInput" onfocus="InputGroup(this)"></div>
				</div>
			</div>
		</div>
				
			<div id="onlineList" class="onlineList">
				<div id="OnlineHeader" class="OnlineHeader">Online Users</div>
				<div id="listContainer" class="listContainer"></div>
			</div>
			
	</body>
</html>