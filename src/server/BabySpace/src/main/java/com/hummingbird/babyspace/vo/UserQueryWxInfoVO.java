package com.hummingbird.babyspace.vo;

public class UserQueryWxInfoVO {
	/*"wxInfo":{
	    "openid":"oITR0uAkXSsTgY2YaU2ItDN2kh7g",
	    "nickname":"大师你懂吗",
	    "sex":"1",   
	    "headimgurl":"http://wx.qlogo.cn/mmopen/PiajxSqBRaEInIaAHHYN9ia0CF5rUljZlhDMHniaoft7MXwXDtLTHuACWyWTePqpvVc2qL6aGZchEUBg5X0RZsxyQ/0",
	    "unionId":"olbkKt-8vkqpPod-N7i1SzSxddIo",
	    "subscribe":"1"
    }*/
	private Integer wxId;
	private String openid;
	private String nickname;
	private String sex;
	private String headimgurl;
	private String unionId;
	private String subscribe;
	
	public Integer getWxId() {
		return wxId;
	}
	public void setWxId(Integer wxId) {
		this.wxId = wxId;
	}
	public String getOpenid() {
		return openid;
	}
	public void setOpenid(String openid) {
		this.openid = openid;
	}
	public String getNickname() {
		return nickname;
	}
	public void setNickname(String nickname) {
		this.nickname = nickname;
	}
	public String getSex() {
		return sex;
	}
	public void setSex(String sex) {
		this.sex = sex;
	}
	
	public String getHeadimgurl() {
		return headimgurl;
	}
	public void setHeadimgurl(String headimgurl) {
		this.headimgurl = headimgurl;
	}
	public String getUnionId() {
		return unionId;
	}
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	public String getSubscribe() {
		return subscribe;
	}
	public void setSubscribe(String subscribe) {
		this.subscribe = subscribe;
	}
	
	
}
