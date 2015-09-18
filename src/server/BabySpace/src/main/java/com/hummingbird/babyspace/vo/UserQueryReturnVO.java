package com.hummingbird.babyspace.vo;

public class UserQueryReturnVO {
	private Boolean isMember;
	private UserQueryWxInfoVO wxInfo;
	private UserQueryUserInfoVO userInfo;
	public Boolean getIsMember() {
		return isMember;
	}
	public void setIsMember(Boolean isMember) {
		this.isMember = isMember;
	}
	public UserQueryWxInfoVO getWxInfo() {
		return wxInfo;
	}
	public void setWxInfo(UserQueryWxInfoVO wxInfo) {
		this.wxInfo = wxInfo;
	}
	public UserQueryUserInfoVO getUserInfo() {
		return userInfo;
	}
	public void setUserInfo(UserQueryUserInfoVO userInfo) {
		this.userInfo = userInfo;
	}
	
}
