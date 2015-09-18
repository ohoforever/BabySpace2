package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 宝贝成长评论表
 */
public class BabyMatureComment {
    private Integer id;

    /**
     * 成长记录id
     */
    private Integer matureId;

    /**
     * 发送者身份,TECH-老师,USER-家长
     */
    private String senderType;

    /**
     * 用户id
     */
    private Integer senderId;

    /**
     * 回复记录id
     */
    private Integer replyTo;

    /**
     * 评论内容
     */
    private String content;

    /**
     * 评论时间
     */
    private Date insertTime;

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 成长记录id
     */
    public Integer getMatureId() {
        return matureId;
    }

    /**
     * @param matureId 
	 *            成长记录id
     */
    public void setMatureId(Integer matureId) {
        this.matureId = matureId;
    }

    /**
     * @return 发送者身份,TECH-老师,USER-家长
     */
    public String getSenderType() {
        return senderType;
    }

    /**
     * @param senderType 
	 *            发送者身份,TECH-老师,USER-家长
     */
    public void setSenderType(String senderType) {
        this.senderType = senderType == null ? null : senderType.trim();
    }

    /**
     * @return 用户id
     */
    public Integer getSenderId() {
        return senderId;
    }

    /**
     * @param senderId 
	 *            用户id
     */
    public void setSenderId(Integer senderId) {
        this.senderId = senderId;
    }

    /**
     * @return 回复记录id
     */
    public Integer getReplyTo() {
        return replyTo;
    }

    /**
     * @param replyTo 
	 *            回复记录id
     */
    public void setReplyTo(Integer replyTo) {
        this.replyTo = replyTo;
    }

    /**
     * @return 评论内容
     */
    public String getContent() {
        return content;
    }

    /**
     * @param content 
	 *            评论内容
     */
    public void setContent(String content) {
        this.content = content == null ? null : content.trim();
    }

    /**
     * @return 评论时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            评论时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }
}