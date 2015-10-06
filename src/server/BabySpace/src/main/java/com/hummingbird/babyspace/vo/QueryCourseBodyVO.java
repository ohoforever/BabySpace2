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

/**
 * 类别,SPD-耗课,CZH-冲正
 */
private String type;

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
/**
 * 类别SPD-耗课CZH-冲正 
 */
public String getType() {
	return type;
}
/**
 * 类别SPD-耗课CZH-冲正 
 */
public void setType(String type) {
	this.type = type;
}
/* (non-Javadoc)
 * @see java.lang.Object#toString()
 */
@Override
public String toString() {
	return "QueryCourseBodyVO [unionId=" + unionId + ", mobileNum=" + mobileNum + ", courseNum=" + courseNum
			+ ", courseName=" + courseName + ", type=" + type + "]";
}

}
