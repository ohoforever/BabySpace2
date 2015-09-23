package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 微信绑定历史表
 */
public class WxBindingHistory {
    /**
     * 历史id
     */
    private Integer id;

    /**
     * 微信id
     */
    private String unionId;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 学校名
     */
    private String mobileNum;

    /**
     * ADD 新增绑定,UPT 更新,DEL 解除绑定
     */
    private String type;

    /**
     * @return 历史id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            历史id
     */
    public void setId(Integer id) {
        this.id = id;
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
     * @return 学校名
     */
    public String getMobileNum() {
        return mobileNum;
    }

    /**
     * @param mobileNum 
	 *            学校名
     */
    public void setMobileNum(String mobileNum) {
        this.mobileNum = mobileNum == null ? null : mobileNum.trim();
    }

    /**
     * @return ADD 新增绑定,UPT 更新,DEL 解除绑定
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            ADD 新增绑定,UPT 更新,DEL 解除绑定
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
    }
}