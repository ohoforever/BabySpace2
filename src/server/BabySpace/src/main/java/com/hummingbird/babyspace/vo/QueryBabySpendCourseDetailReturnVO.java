package com.hummingbird.babyspace.vo;

public class QueryBabySpendCourseDetailReturnVO {
	 /*"list":[{
		    "courseName":"幼儿心理",
		    "orderId":"23487398",
		    "babyName":"宝宝名字",
		    "updateTime":"2015-09-01 01:21:54",
		    "courseCount":"10"
		    },*/
	private String courseName;
	private String schoolName;
	private String orderId;
	private String babyName;
	private String updateTime;
	private Integer courseCount;
	
	public String getSchoolName() {
		return schoolName;
	}
	public void setSchoolName(String schoolName) {
		this.schoolName = schoolName;
	}
	public String getCourseName() {
		return courseName;
	}
	public void setCourseName(String courseName) {
		this.courseName = courseName;
	}
	public String getOrderId() {
		return orderId;
	}
	public void setOrderId(String orderId) {
		this.orderId = orderId;
	}
	public String getBabyName() {
		return babyName;
	}
	public void setBabyName(String babyName) {
		this.babyName = babyName;
	}
	public String getUpdateTime() {
		return updateTime;
	}
	public void setUpdateTime(String updateTime) {
		this.updateTime = updateTime;
	}
	public Integer getCourseCount() {
		return courseCount;
	}
	public void setCourseCount(Integer courseCount) {
		this.courseCount = courseCount;
	}
	
	
	
}
