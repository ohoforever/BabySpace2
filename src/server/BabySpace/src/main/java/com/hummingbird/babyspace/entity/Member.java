package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 会员表
 */
public class Member {
    /**
     * 会员id
     */
    private Integer id;

    /**
     * 用户id
     */
    private Integer userId;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 更新时间
     */
    private Date updateTime;

    /**
     * 状态,OK#正常,END终止会员身份
     */
    private String status;

    /**
     * @return 会员id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            会员id
     */
    public void setId(Integer id) {
        this.id = id;
    }

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
     * @return 状态,OK#正常,END终止会员身份
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态,OK#正常,END终止会员身份
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
    }
}