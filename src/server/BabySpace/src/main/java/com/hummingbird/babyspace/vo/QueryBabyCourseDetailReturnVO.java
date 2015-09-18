package com.hummingbird.babyspace.vo;
/**
 * @Description: 查询要消耗的课程信息
 * @author liudou
 *
 */
public class QueryBabyCourseDetailReturnVO {
	/*"list":[{
		   "babyName":"蚯蚓",
		   "childId":645,
		   "courseName":"音律",
		   "orderId":"43647",
		   "courseNum":2
		}]*/
	private String babyName;
	private Integer childId;
	private String courseName;
	private String orderId;
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
	public Integer getCourseNum() {
		return courseNum;
	}
	public void setCourseNum(Integer courseNum) {
		this.courseNum = courseNum;
	}
	
	
	
}
