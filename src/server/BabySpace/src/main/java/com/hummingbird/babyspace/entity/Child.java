package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 宝宝表
 */
public class Child {
    /**
     * 宝宝id
     */
    private Integer id;

    /**
     * 家长id
     */
    private Integer userId;

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
     * @return 宝宝id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            宝宝id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 家长id
     */
    public Integer getUserId() {
        return userId;
    }

    /**
     * @param userId 
	 *            家长id
     */
    public void setUserId(Integer userId) {
        this.userId = userId;
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
}