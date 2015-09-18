package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 预约表
 */
public class Appointment {
    /**
     * 预约id
     */
    private Integer id;

    /**
     * 家长手机号
     */
    private Integer mobileNum;

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

    private Integer unionId;

    /**
     * @return 预约id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            预约id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 家长手机号
     */
    public Integer getMobileNum() {
        return mobileNum;
    }

    /**
     * @param mobileNum 
	 *            家长手机号
     */
    public void setMobileNum(Integer mobileNum) {
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

    public Integer getUnionId() {
        return unionId;
    }

    public void setUnionId(Integer unionId) {
        this.unionId = unionId;
    }
}