package controller.coder;

import java.io.StringReader;

import javax.json.Json;
import javax.json.JsonException;
import javax.json.JsonObject;
import javax.websocket.DecodeException;
import javax.websocket.Decoder;
import javax.websocket.EndpointConfig;

import com.fasterxml.jackson.databind.ObjectMapper;

import controller.message.GroupMessage;
import controller.message.PrivateMessage;
import controller.message.Message;

public class MessageDecoder implements Decoder.Text<Message>{

	Message message = null;
	@Override
	public Message decode(String msg) throws DecodeException {
		Message message = null;
		if(willDecode(msg)){
			try{
				JsonObject obj = (JsonObject) Json.createReader(new StringReader(msg)).readObject();
				ObjectMapper objectMapper = new ObjectMapper(); 
				
				String ACTION = obj.getString("action");
				
				switch(ACTION){
					case "GROUP" : 
							message =  (Message) objectMapper.readValue(msg, GroupMessage.class);
						break;
					case "PRIVATE":
							message  = (Message) objectMapper.readValue(msg, PrivateMessage.class);
						break;
				}
			}catch(Exception  e){
				e.printStackTrace();
			}
		}
		return message;
	}

	@Override
	public boolean willDecode(String msg) {
		try{
			Json.createReader(new StringReader(msg));
			return true;
		}catch(JsonException e){
			return false;
		}
	}

	@Override
	public void destroy() {
		
	}

	@Override
	public void init(EndpointConfig arg0) {
		
	}

}
