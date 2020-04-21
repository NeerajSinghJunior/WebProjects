package controller.message;

public class PrivateMessage extends Message{
	private String to,message,from;

	public String getMessage() {
		return message;
	}

	public void setMESSAGE(String message) {
		this.message = message;
	}

	public String getTo() {
		return to;
	}

	public void setTo(String to) {
		this.to = to;
	}

	public String getFrom() {
		return from;
	}

	public void setFrom(String from) {
		this.from = from;
	}
	
}