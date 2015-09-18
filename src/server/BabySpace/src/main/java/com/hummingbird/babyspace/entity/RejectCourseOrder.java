package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 会员退课表
 */
public class RejectCourseOrder {
    /**
     * 订单id
     */
    private String orderId;

    /**
     * 宝宝id
     */
    private Integer childId;

    /**
     * 学校名
     */
    private String schoolName;

    /**
     * 课程名
     */
    private String courseName;

    /**
     * 退课课数
     */
    private Integer courseCount;

    /**
     * 退课费用,单位分
     */
    private Integer courseAmount;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 更新时间
     */
    private Date updateTime;

    /**
     * 状态,OK#正常,FLS失败
     */
    private String status;

    /**
     * 经办人
     */
    private Integer operator;

    /**
     * @return 订单id
     */
    public String getOrderId() {
        return orderId;
    }

    /**
     * @param orderId 
	 *            订单id
     */
    public void setOrderId(String orderId) {
        this.orderId = orderId == null ? null : orderId.trim();
    }

    /**
     * @return 宝宝id
     */
    public Integer getChildId() {
        return childId;
    }

    /**
     * @param childId 
	 *            宝宝id
     */
    public void setChildId(Integer childId) {
        this.childId = childId;
    }

    /**
     * @return 学校名
     */
    public String getSchoolName() {
        return schoolName;
    }

    /**
     * @param schoolName 
	 *            学校名
     */
    public void setSchoolName(String schoolName) {
        this.schoolName = schoolName == null ? null : schoolName.trim();
    }

    /**
     * @return 课程名
     */
    public String getCourseName() {
        return courseName;
    }

    /**
     * @param courseName 
	 *            课程名
     */
    public void setCourseName(String courseName) {
        this.courseName = courseName == null ? null : courseName.trim();
    }

    /**
     * @return 退课课数
     */
    public Integer getCourseCount() {
        return courseCount;
    }

    /**
     * @param courseCount 
	 *            退课课数
     */
    public void setCourseCount(Integer courseCount) {
        this.courseCount = courseCount;
    }

    /**
     * @return 退课费用,单位分
     */
    public Integer getCourseAmount() {
        return courseAmount;
    }

    /**
     * @param courseAmount 
	 *            退课费用,单位分
     */
    public void setCourseAmount(Integer courseAmount) {
        this.courseAmount = courseAmount;
    }

    /**
     * @return 添加时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            添加时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 更新时间
     */
    public Date getUpdateTime() {
        return updateTime;
    }

    /**
     * @param updateTime 
	 *            更新时间
     */
    public void setUpdateTime(Date updateTime) {
        this.updateTime = updateTime;
    }

    /**
     * @return 状态,OK#正常,FLS失败
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态,OK#正常,FLS失败
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
    }

    /**
     * @return 经办人
     */
    public Integer getOperator() {
        return operator;
    }

    /**
     * @param operator 
	 *            经办人
     */
    public void setOperator(Integer operator) {
        this.operator = operator;
    }
}