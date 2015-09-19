package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 点赞表
 */
public class Like {
    private Integer id;

    /**
     * 记录id
     */
    private Integer recordId;

    /**
     * 微信id
     */
    private String unionId;

    /**
     * 点赞时间
     */
    private Date insertTime;

    /**
     * 类型,WDFUL-宝贝精彩,MATRE-成长时光
     */
    private String type;

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 记录id
     */
    public Integer getRecordId() {
        return recordId;
    }

    /**
     * @param recordId 
	 *            记录id
     */
    public void setRecordId(Integer recordId) {
        this.recordId = recordId;
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
     * @return 点赞时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            点赞时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 类型,WDFUL-宝贝精彩,MATRE-成长时光
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            类型,WDFUL-宝贝精彩,MATRE-成长时光
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }
}