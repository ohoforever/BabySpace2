package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 分享历史表
 */
public class Share {
    /**
     * 记录id
     */
    private Integer id;

    /**
     * 分享人微信号
     */
    private String unionId;

    /**
     * 记录id
     */
    private Integer recordId;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 类型,WDFUL-宝贝精彩,MATRE-成长时光,APPOIN-预约分享
     */
    private String type;

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
     * @return 分享人微信号
     */
    public String getUnionId() {
        return unionId;
    }

    /**
     * @param unionId 
	 *            分享人微信号
     */
    public void setUnionId(String unionId) {
        this.unionId = unionId == null ? null : unionId.trim();
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
     * @return 类型,WDFUL-宝贝精彩,MATRE-成长时光,APPOIN-预约分享
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            类型,WDFUL-宝贝精彩,MATRE-成长时光,APPOIN-预约分享
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }
}