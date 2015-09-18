package com.hummingbird.babyspace.vo;

public class UserRegBodyVO {
	/*"body": {
	    "openId":"oITR0uAkXSsTgY2YaU2ItDN2kh7g",
	    "nickname":"大师你懂吗",
	    "sex":"1",
	    "language":"zh_CN",
	    "city":"深圳",
	    "province":"广东",
	    "country":"中国",      
	    "headimgurl":"http://wx.qlogo.cn/mmopen/PiajxSqBRaEInIaAHHYN9ia0CF5rUljZlhDMHniaoft7MXwXDtLTHuACWyWTePqpvVc2qL6aGZchEUBg5X0RZsxyQ/0",
	    "subscribe_time":"1440076007",
	    "unionId":"olbkKt-8vkqpPod-N7i1SzSxddIo",
	    "remark":"",
	    "subscribe":"1",
	    "groupid":"0",
	    "privilege":""
	
	},*/
	private String openId;
	private String nickname;
	private String sex;
	private String language;
	private String city;
	private String province;
	private String country;
	private String headimgurl;
	private String unionId;
	private String remark;
	private String subscribe;
	private String groupid;
	private String subscribe_time;
	private String privilege;
	public String getOpenId() {
		return openId;
	}
	public void setOpenId(String openId) {
		this.openId = openId;
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
	public String getLanguage() {
		return language;
	}
	public void setLanguage(String language) {
		this.language = language;
	}
	public String getCity() {
		return city;
	}
	public void setCity(String city) {
		this.city = city;
	}
	public String getProvince() {
		return province;
	}
	public void setProvince(String province) {
		this.province = province;
	}
	public String getCountry() {
		return country;
	}
	public void setCountry(String country) {
		this.country = country;
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
	public String getRemark() {
		return remark;
	}
	public void setRemark(String remark) {
		this.remark = remark;
	}
	public String getSubscribe() {
		return subscribe;
	}
	public void setSubscribe(String subscribe) {
		this.subscribe = subscribe;
	}
	public String getGroupid() {
		return groupid;
	}
	public void setGroupid(String groupid) {
		this.groupid = groupid;
	}
	public String getSubscribe_time() {
		return subscribe_time;
	}
	public void setSubscribe_time(String subscribe_time) {
		this.subscribe_time = subscribe_time;
	}
	public String getPrivilege() {
		return privilege;
	}
	public void setPrivilege(String privilege) {
		this.privilege = privilege;
	}
	
}
