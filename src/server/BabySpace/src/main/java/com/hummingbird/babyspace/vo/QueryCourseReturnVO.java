package com.hummingbird.babyspace.vo;

public class QueryCourseReturnVO {
	/*{
		   "babyName":"蚯蚓2",
		   "childId":625,
		   "courseName":"音律",
		   "orderId":"43647",
		   "courseNum":2
		}*/
private String babyName;
private Integer childId;
private String courseName;
private String orderId;
private Integer courseNum;
public String getBabyName() {
	return babyName;
}
public void setBabyName(String babyName) {
	this.babyName = babyName;
}
public Integer getChildId() {
	return childId;
}
public void setChildId(Integer childId) {
	this.childId = childId;
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
public Integer getCourseNum() {
	return courseNum;
}
public void setCourseNum(Integer courseNum) {
	this.courseNum = courseNum;
}

}
