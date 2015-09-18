package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 用户表
 */
public class User {
    /**
     * 用户id
     */
    private Integer id;

    /**
     * 家长名称
     */
    private String userName;

    private String mobileNum;

    /**
     * 家庭所有城市
     */
    private String city;

    /**
     * 家庭所在地区
     */
    private String district;

    /**
     * 插入时间
     */
    private Date insertTime;

    /**
     * 修改时间
     */
    private Date updateTime;

    /**
     * 微信id
     */
    private String unionId;

    /**
     * qq号
     */
    private String qq;

    /**
     * 邮件
     */
    private String email;

    /**
     * @return 用户id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            用户id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 家长名称
     */
    public String getUserName() {
        return userName;
    }

    /**
     * @param userName 
	 *            家长名称
     */
    public void setUserName(String userName) {
        this.userName = userName == null ? null : userName.trim();
    }

    public String getMobileNum() {
        return mobileNum;
    }

    public void setMobileNum(String mobileNum) {
        this.mobileNum = mobileNum == null ? null : mobileNum.trim();
    }

    /**
     * @return 家庭所有城市
     */
    public String getCity() {
        return city;
    }

    /**
     * @param city 
	 *            家庭所有城市
     */
    public void setCity(String city) {
        this.city = city == null ? null : city.trim();
    }

    /**
     * @return 家庭所在地区
     */
    public String getDistrict() {
        return district;
    }

    /**
     * @param district 
	 *            家庭所在地区
     */
    public void setDistrict(String district) {
        this.district = district == null ? null : district.trim();
    }

    /**
     * @return 插入时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            插入时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 修改时间
     */
    public Date getUpdateTime() {
        return updateTime;
    }

    /**
     * @param updateTime 
	 *            修改时间
     */
    public void setUpdateTime(Date updateTime) {
        this.updateTime = updateTime;
    }

    /**
     * @return 微信id
     */
    public String getUnionId() {
        return unionId;
    }

    /**
     * @param unionId 
	 *            微信id
     */
    public void setUnionId(String unionId) {
        this.unionId = unionId == null ? null : unionId.trim();
    }

    /**
     * @return qq号
     */
    public String getQq() {
        return qq;
    }

    /**
     * @param qq 
	 *            qq号
     */
    public void setQq(String qq) {
        this.qq = qq == null ? null : qq.trim();
    }

    /**
     * @return 邮件
     */
    public String getEmail() {
        return email;
    }

    /**
     * @param email 
	 *            邮件
     */
    public void setEmail(String email) {
        this.email = email == null ? null : email.trim();
    }
}