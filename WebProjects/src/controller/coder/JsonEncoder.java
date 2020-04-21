package controller.coder;

import javax.json.Json;
import javax.json.JsonArrayBuilder;
import javax.json.JsonObject;
import javax.json.JsonObjectBuilder;

public class JsonEncoder {
	public static JsonObjectBuilder obj = Json.createObjectBuilder();
	public static JsonArrayBuilder jsonArray = Json.createArrayBuilder();
	
	public void jsonObjectcreater( String param, String value){
		obj.add(param, value);
	}
	
	public void  jsonObjectBuilder(){
		JsonObject jsonObject = (JsonObject)obj.build();
		String str = jsonObject.toString();
		jsonArray.add(str);
	}
	
	public String jsonArrayBuilder(){
		return jsonArray.build().toString();
	}
	
}
