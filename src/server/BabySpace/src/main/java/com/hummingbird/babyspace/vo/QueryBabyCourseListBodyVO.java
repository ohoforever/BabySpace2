package com.hummingbird.babyspace.vo;

import com.hummingbird.babyspace.face.Pagingnation;

/**
 * @Description:查询要消耗的课程信息
 * @author liudou
 *
 */
public class QueryBabyCourseListBodyVO {
	
	private String unionId;
	private String courseName;
	private Integer courseNum;
	public String getUnionId() {
		return unionId;
	}
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	public String getCourseName() {
		return courseName;
	}
	public void setCourseName(String courseName) {
		this.courseName = courseName;
	}
	public Integer getCourseNum() {
		return courseNum;
	}
	public void setCourseNum(Integer courseNum) {
		this.courseNum = courseNum;
	}
	
}
