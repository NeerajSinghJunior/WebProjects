package controller.message;

import java.util.HashMap;

public class OnlineUserList extends Message {

	public HashMap<String, String> onlineUsers;
	
	public OnlineUserList(HashMap<String, String> usersClientList) {
		this.setAction("ONLINEUSERS");
		onlineUsers = usersClientList;
	}
}
