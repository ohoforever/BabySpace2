package com.hummingbird.babyspace.vo;

public class QueryBabyCourseHistoryDetailReturnVO {
	/* "list":[{
		    "schoolName":"白云校区",
		    "courseName":"幼儿教育",
		    "babyName":"蚯蚓",
		    "courseCount":"1",
		    "attendTime":"2015-02-01 14:55:09"
		    }]*/
	private String schoolName;
	private String className;
	private String babyName;
	private Integer courseCount;
	private String attendTime;
	/**
     * 类别,SPD-耗课,CZH-冲正
     */
    private String type;

    /**
     * 备注
     */
    private String remark;
	public String getSchoolName() {
		return schoolName;
	}
	public void setSchoolName(String schoolName) {
		this.schoolName = schoolName;
	}
	
	public String getClassName() {
		return className;
	}
	public void setClassName(String className) {
		this.className = className;
	}
	public String getBabyName() {
		return babyName;
	}
	public void setBabyName(String babyName) {
		this.babyName = babyName;
	}
	public Integer getCourseCount() {
		return courseCount;
	}
	public void setCourseCount(Integer courseCount) {
		this.courseCount = courseCount;
	}
	public String getAttendTime() {
		return attendTime;
	}
	public void setAttendTime(String attendTime) {
		this.attendTime = attendTime;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "QueryBabyCourseHistoryDetailReturnVO [schoolName=" + schoolName + ", className=" + className
				+ ", babyName=" + babyName + ", courseCount=" + courseCount + ", attendTime=" + attendTime + ", type="
				+ type + ", remark=" + remark + "]";
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
	
}
