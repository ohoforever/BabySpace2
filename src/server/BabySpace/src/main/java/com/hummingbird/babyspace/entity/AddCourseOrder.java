package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 会员报课表
 */
public class AddCourseOrder {
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
     * 报课课数,用户购买多少节课,它与课程的课数不一定相同
     */
    private Integer courseCount;

    /**
     * 买课费用,单位分
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
     * 课程总课数,它与课程有关
     */
    private Integer courseTotal;

    /**
     * 赠送课程数
     */
    private Integer givenCount;

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
     * @return 报课课数,用户购买多少节课,它与课程的课数不一定相同
     */
    public Integer getCourseCount() {
        return courseCount;
    }

    /**
     * @param courseCount 
	 *            报课课数,用户购买多少节课,它与课程的课数不一定相同
     */
    public void setCourseCount(Integer courseCount) {
        this.courseCount = courseCount;
    }

    /**
     * @return 买课费用,单位分
     */
    public Integer getCourseAmount() {
        return courseAmount;
    }

    /**
     * @param courseAmount 
	 *            买课费用,单位分
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

    /**
     * @return 课程总课数,它与课程有关
     */
    public Integer getCourseTotal() {
        return courseTotal;
    }

    /**
     * @param courseTotal 
	 *            课程总课数,它与课程有关
     */
    public void setCourseTotal(Integer courseTotal) {
        this.courseTotal = courseTotal;
    }

    /**
     * @return 赠送课程数
     */
    public Integer getGivenCount() {
        return givenCount;
    }

    /**
     * @param givenCount 
	 *            赠送课程数
     */
    public void setGivenCount(Integer givenCount) {
        this.givenCount = givenCount;
    }
}