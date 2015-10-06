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
/**
 * 类别,SPD-耗课,CZH-冲正
 */
private String type;

/**
 * 备注
 */
private String remark;
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
/**
 * 备注 
 */
public String getRemark() {
	return remark;
}
/**
 * 备注 
 */
public void setRemark(String remark) {
	this.remark = remark;
}
/* (non-Javadoc)
 * @see java.lang.Object#toString()
 */
@Override
public String toString() {
	return "QueryCourseReturnVO [babyName=" + babyName + ", childId=" + childId + ", courseName=" + courseName
			+ ", orderId=" + orderId + ", courseNum=" + courseNum + ", type=" + type + ", remark=" + remark + "]";
}

}
