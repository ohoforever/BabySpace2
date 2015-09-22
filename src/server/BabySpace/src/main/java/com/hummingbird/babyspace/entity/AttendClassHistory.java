package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 宝贝上课记录历史表
 */
public class AttendClassHistory {
    /**
     * 记录id
     */
    private Integer id;

    /**
     * 宝宝id
     */
    private Integer childId;

    /**
     * 课程名称
     */
    private String classname;

    /**
     * 耗课节数
     */
    private Integer courseCount;

    /**
     * 活动时间
     */
    private Date actTime;

    /**
     * 添加时间
     */
    private Date insertTime;

    private Date updateTime;

    /**
     * 状态,OK#正常,FLS失败
     */
    private String status;

    /**
     * 录入人
     */
    private Integer operator;

    /**
     * 消耗报课的订单号
     */
    private String orderId;

    /**
     * 剩下课时
     */
    private Integer leftCourseCount;

    /**
     * 操作类型,ADD-新增,DEL-删除,UPT-更新
     */
    private String type;

    /**
     * 报课id
     */
    private Integer attendId;

    /**
     * @return 记录id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            记录id
     */
    public void setId(Integer id) {
        this.id = id;
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
     * @return 课程名称
     */
    public String getClassname() {
        return classname;
    }

    /**
     * @param classname 
	 *            课程名称
     */
    public void setClassname(String classname) {
        this.classname = classname == null ? null : classname.trim();
    }

    /**
     * @return 耗课节数
     */
    public Integer getCourseCount() {
        return courseCount;
    }

    /**
     * @param courseCount 
	 *            耗课节数
     */
    public void setCourseCount(Integer courseCount) {
        this.courseCount = courseCount;
    }

    /**
     * @return 活动时间
     */
    public Date getActTime() {
        return actTime;
    }

    /**
     * @param actTime 
	 *            活动时间
     */
    public void setActTime(Date actTime) {
        this.actTime = actTime;
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

    public Date getUpdateTime() {
        return updateTime;
    }

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
     * @return 录入人
     */
    public Integer getOperator() {
        return operator;
    }

    /**
     * @param operator 
	 *            录入人
     */
    public void setOperator(Integer operator) {
        this.operator = operator;
    }

    /**
     * @return 消耗报课的订单号
     */
    public String getOrderId() {
        return orderId;
    }

    /**
     * @param orderId 
	 *            消耗报课的订单号
     */
    public void setOrderId(String orderId) {
        this.orderId = orderId == null ? null : orderId.trim();
    }

    /**
     * @return 剩下课时
     */
    public Integer getLeftCourseCount() {
        return leftCourseCount;
    }

    /**
     * @param leftCourseCount 
	 *            剩下课时
     */
    public void setLeftCourseCount(Integer leftCourseCount) {
        this.leftCourseCount = leftCourseCount;
    }

    /**
     * @return 操作类型,ADD-新增,DEL-删除,UPT-更新
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            操作类型,ADD-新增,DEL-删除,UPT-更新
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }

    /**
     * @return 报课id
     */
    public Integer getAttendId() {
        return attendId;
    }

    /**
     * @param attendId 
	 *            报课id
     */
    public void setAttendId(Integer attendId) {
        this.attendId = attendId;
    }
}