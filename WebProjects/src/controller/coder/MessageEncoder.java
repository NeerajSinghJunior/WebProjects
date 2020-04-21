package controller.coder;

import javax.websocket.EncodeException;
import javax.websocket.Encoder;
import javax.websocket.EndpointConfig;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

import controller.message.Message;

public class MessageEncoder implements Encoder.Text<Message> {

	@Override
	public String encode(Message MESSAGE) throws EncodeException {
		ObjectMapper mapper = new ObjectMapper();
		try{
			String a = mapper.writeValueAsString(MESSAGE);
			return a;
			}catch(JsonProcessingException e){
				e.printStackTrace();
			}
		return "";
	}

	@Override
	public void destroy() {
		
	}

	@Override
	public void init(EndpointConfig arg0) {
		
	}
	
}
