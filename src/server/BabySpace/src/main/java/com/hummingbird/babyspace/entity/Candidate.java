package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 待开发客户表
 */
public class Candidate {
    /**
     * 客户id
     */
    private Integer id;

    /**
     * 家长手机号
     */
    private String mobileNum;

    /**
     * 家长名称
     */
    private String parentName;

    /**
     * 宝宝名称
     */
    private String babyName;

    /**
     * 宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    private String babySex;

    /**
     * 宝宝出生年月
     */
    private Date babyBirthday;

    /**
     * 家庭所有城市
     */
    private String city;

    /**
     * 家庭所在地区
     */
    private String district;

    /**
     * 用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    private String level;

    /**
     * 当前的业务员
     */
    private Integer currentAssistantId;

    /**
     * 状态,OK#开发完成,FLS开发失败,不进行开发,CRT新客户待开发
     */
    private String status;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 候选人星数,分5等,5分最高,1分最低
     */
    private Integer star;

    /**
     * @return 客户id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            客户id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 家长手机号
     */
    public String getMobileNum() {
        return mobileNum;
    }

    /**
     * @param mobileNum 
	 *            家长手机号
     */
    public void setMobileNum(String mobileNum) {
        this.mobileNum = mobileNum;
    }

    /**
     * @return 家长名称
     */
    public String getParentName() {
        return parentName;
    }

    /**
     * @param parentName 
	 *            家长名称
     */
    public void setParentName(String parentName) {
        this.parentName = parentName == null ? null : parentName.trim();
    }

    /**
     * @return 宝宝名称
     */
    public String getBabyName() {
        return babyName;
    }

    /**
     * @param babyName 
	 *            宝宝名称
     */
    public void setBabyName(String babyName) {
        this.babyName = babyName == null ? null : babyName.trim();
    }

    /**
     * @return 宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    public String getBabySex() {
        return babySex;
    }

    /**
     * @param babySex 
	 *            宝宝性别,MALE男宝宝,FEMAIL女宝宝,UNKNOWN不详
     */
    public void setBabySex(String babySex) {
        this.babySex = babySex == null ? null : babySex.trim();
    }

    /**
     * @return 宝宝出生年月
     */
    public Date getBabyBirthday() {
        return babyBirthday;
    }

    /**
     * @param babyBirthday 
	 *            宝宝出生年月
     */
    public void setBabyBirthday(Date babyBirthday) {
        this.babyBirthday = babyBirthday;
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
     * @return 用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    public String getLevel() {
        return level;
    }

    /**
     * @param level 
	 *            用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    public void setLevel(String level) {
        this.level = level == null ? null : level.trim();
    }

    /**
     * @return 当前的业务员
     */
    public Integer getCurrentAssistantId() {
        return currentAssistantId;
    }

    /**
     * @param currentAssistantId 
	 *            当前的业务员
     */
    public void setCurrentAssistantId(Integer currentAssistantId) {
        this.currentAssistantId = currentAssistantId;
    }

    /**
     * @return 状态,OK#开发完成,FLS开发失败,不进行开发,CRT新客户待开发
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态,OK#开发完成,FLS开发失败,不进行开发,CRT新客户待开发
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
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
     * @return 候选人星数,分5等,5分最高,1分最低
     */
    public Integer getStar() {
        return star;
    }

    /**
     * @param star 
	 *            候选人星数,分5等,5分最高,1分最低
     */
    public void setStar(Integer star) {
        this.star = star;
    }
}