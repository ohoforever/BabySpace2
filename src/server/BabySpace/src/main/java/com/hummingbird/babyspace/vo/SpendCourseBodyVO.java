package com.hummingbird.babyspace.vo;

public class SpendCourseBodyVO {
	/*"body":{
    "childId":543,
	"courseName":"音律",
	"courseNum":2,
	"orderId":"43647",
	"operator":1
	}*/
	private String courseName;
	private String orderId;
	private Integer operator;
	private Integer childId;
	private Integer courseNum;
	/**
	 * 类别,SPD-耗课,CZH-冲正
	 */
	private String type;
	
	/**
	 * 备注
	 */
	private String remark;
	
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
	public Integer getOperator() {
		return operator;
	}
	public void setOperator(Integer operator) {
		this.operator = operator;
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
		return "SpendCourseBodyVO [courseName=" + courseName + ", orderId=" + orderId + ", operator=" + operator
				+ ", childId=" + childId + ", courseNum=" + courseNum + ", type=" + type + ", remark=" + remark + "]";
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
