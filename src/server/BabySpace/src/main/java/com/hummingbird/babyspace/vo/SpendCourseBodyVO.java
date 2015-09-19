package com.hummingbird.babyspace.vo;

public class SpendCourseBodyVO {
	/*"body":{
    "childId":543,
	"courseName":"音律",
	"courseNum":2,
	"orderId":"43647",
	}*/
	private String courseName;
	private String orderId;
	private Integer childId;
	private Integer courseNum;
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
	public Integer getChildId() {
		return childId;
	}
	public void setChildId(Integer childId) {
		this.childId = childId;
	}
	public Integer getCourseNum() {
		return courseNum;
	}
	public void setCourseNum(Integer courseNum) {
		this.courseNum = courseNum;
	}
}
