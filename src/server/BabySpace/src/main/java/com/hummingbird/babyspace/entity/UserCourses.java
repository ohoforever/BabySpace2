package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 会员课数表
 */
public class UserCourses {
    /**
     * 用户id
     */
    private Integer userId;

    /**
     * 总课数
     */
    private Integer courseCount;

    /**
     * 剩余课数
     */
    private Integer courseLeft;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 更新时间
     */
    private Date updateTime;

    /**
     * @return 用户id
     */
    public Integer getUserId() {
        return userId;
    }

    /**
     * @param userId 
	 *            用户id
     */
    public void setUserId(Integer userId) {
        this.userId = userId;
    }

    /**
     * @return 总课数
     */
    public Integer getCourseCount() {
        return courseCount;
    }

    /**
     * @param courseCount 
	 *            总课数
     */
    public void setCourseCount(Integer courseCount) {
        this.courseCount = courseCount;
    }

    /**
     * @return 剩余课数
     */
    public Integer getCourseLeft() {
        return courseLeft;
    }

    /**
     * @param courseLeft 
	 *            剩余课数
     */
    public void setCourseLeft(Integer courseLeft) {
        this.courseLeft = courseLeft;
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
}