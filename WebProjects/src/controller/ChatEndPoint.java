package controller;

import java.io.IOException;
import java.util.Collections;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Set;
import java.util.concurrent.CopyOnWriteArraySet;

import javax.websocket.EncodeException;
import javax.websocket.OnClose;
import javax.websocket.OnMessage;
import javax.websocket.OnOpen;
import javax.websocket.Session;
import javax.websocket.server.ServerEndpoint;

import controller.coder.MessageDecoder;
import controller.coder.MessageEncoder;
import controller.message.GroupMessage;
import controller.message.Message;
import controller.message.OnlineUserList;
import controller.message.PrivateMessage;

import java.sql.*;
import database.*;

@ServerEndpoint(value="/ChatServerEndpoint",
				encoders=MessageEncoder.class,
				decoders=MessageDecoder.class)

public class ChatEndPoint{
	PreparedStatement stmt;
	String query,query2;
	
	static HashMap<String, String> usersServerList = new HashMap<String, String>();
	static HashMap<String, String> usersClientList = new HashMap<String, String>();

	static Set<Session>  Users = Collections.synchronizedSet(new HashSet<Session>());
	private static Set <ChatEndPoint> connections = new CopyOnWriteArraySet<>();

	private String userId,userName;
	private Session session;
	
	Connection con = DataBaseConnection.getConnection();
	
	public ChatEndPoint(){
		userName = null;
	}
	
	@OnOpen
	public void onStart(Session session){
		this.session = session;
		connections.add(this);
		this.userId = session.getPathParameters().get("userId");
		this.userName = session.getPathParameters().get("userName");
		addUserInMap(session.getId(),userId,userName);
		UpdateOnlineUsers();
	}
	
	@OnClose
	public void end(Session session){
		connections.remove(this);
		removeUserInMap(session.getId());
		UpdateOnlineUsers();
	}
	private void removeUserInMap(String id){
		usersClientList.remove(usersServerList.get(id));
		usersServerList.remove(id);
	}
	
	@OnMessage 
	public void Message(Session session, Message message){
		
		if(message instanceof GroupMessage){
			((GroupMessage) message).setFrom(usersServerList.get(session.getId()));
				broadcast((GroupMessage)message);
				addToDataBase((GroupMessage)message);
		}
		if(message instanceof PrivateMessage){
			((PrivateMessage)message).setFrom(usersServerList.get(session.getId()));
			String to = ((PrivateMessage)message).getTo();
			broadcast((PrivateMessage)message,getSessionIdOfUser(to));
			addToDataBase((PrivateMessage)message);
		}
	}
	private void addToDataBase(Message msg){
		try {
			if(msg instanceof GroupMessage){
				if(!con.isClosed()){
					query = "INSERT INTO `groupmessage`(`M_ID`, `From`, `action`, `type`, `Message`) VALUES (?,?,?,?,?)";
					stmt = (PreparedStatement) con.prepareStatement(query);
					stmt.setString(1, null);
					stmt.setString(2, ((GroupMessage) msg).getFrom());
					stmt.setString(3,msg.getAction());
					stmt.setString(4,"text");
					stmt.setString(5,((GroupMessage) msg).getMessage());
					int row = stmt.executeUpdate();
					if(row > 0){
						System.out.println("Group Message Added To dataBase");
					}
				}
			}
			if(msg instanceof PrivateMessage){
				if(!con.isClosed()){
					query = "INSERT INTO `privatemessages`(`M_ID`, `RecId`, `senderId`, `action`, `type`, `Message`) VALUES (?,?,?,?,?,?)";
					stmt = (PreparedStatement) con.prepareStatement(query);
					stmt.setString(1, null);
					stmt.setString(2, ((PrivateMessage) msg).getTo());
					stmt.setString(3,((PrivateMessage) msg).getFrom());
					stmt.setString(4,msg.getAction());
					stmt.setString(5,"text");
					stmt.setString(6,((PrivateMessage) msg).getMessage());
					
					int row = stmt.executeUpdate();
					if(row > 0){
						System.out.println("Private Message Added To dataBase");
					}
				}
			}
		} catch (SQLException e) {
				e.printStackTrace();
		}
	}
	private String getSessionIdOfUser(String to){
		if(usersServerList.containsValue(to)){
			for(String key: usersServerList.keySet()){
				if(usersServerList.get(key).equals(to)){
					return key;
				}
			}
		}
		return null;
	}

	private void broadcast(Message messageToSend, String toSessionId){
		for(ChatEndPoint client :connections ){
			try{
				synchronized(client){
					if(client.session.getId().equals(toSessionId) && session.getId() != client.session.getId())
					{
						client.session.getBasicRemote().sendObject(messageToSend);
					}
				}
			}catch(IOException | EncodeException e){
				connections.remove(client);
				try{
					client.session.close();
				}catch(IOException e1){
					//String message = String.format("*%s %s", client.userName,"has been disconnected");
					//broadcast(message);
				}
			}
		}
		
	}

	public void addUserInMap(String sessionId, String userId,String userName){
		usersServerList.put(sessionId, userId);
		usersClientList.put(userId,userName);
	}

	public void UpdateOnlineUsers(){
		broadcast(new OnlineUserList(ChatEndPoint.usersClientList));
	}
	
	private static void broadcast(Message msg){
		for(ChatEndPoint client :connections ){
			try{
				synchronized(client){
						client.session.getBasicRemote().sendObject(msg);
				}
			}catch(IOException | EncodeException e){
				connections.remove(client);
				try{
					client.session.close();
				}catch(IOException e1){
					//String message = String.format("*%s %s", client.userName,"has been disconnected");
					//broadcast(message);
				}
			}
		}
	}
}