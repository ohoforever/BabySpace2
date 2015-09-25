package com.hummingbird.babyspace.vo;

public class QueryCourseBodyVO {
	/* "body":{
	    "unionId":"2545753",
		"courseNum":2,
		"courseName":"3215"
		}*/
	
private String unionId;
private String mobileNum;
private Integer courseNum;
private String courseName;

public String getMobileNum() {
	return mobileNum;
}
public void setMobileNum(String mobileNum) {
	this.mobileNum = mobileNum;
}
public String getUnionId() {
	return unionId;
}
public void setUnionId(String unionId) {
	this.unionId = unionId;
}
public Integer getCourseNum() {
	return courseNum;
}
public void setCourseNum(Integer courseNum) {
	this.courseNum = courseNum;
}
public String getCourseName() {
	return courseName;
}
public void setCourseName(String courseName) {
	this.courseName = courseName;
}

}
