package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 宝宝问答表，模式为一条意见一条回复
 */
public class Interlocution {
    private Integer id;

    /**
     * 微信id
     */
    private String unionId;

    /**
     * 问题
     */
    private String question;

    /**
     * 提意见时间
     */
    private Date insertTime;

    /**
     * 回复内容
     */
    private String answer;

    /**
     * 回复人
     */
    private Integer replyOperator;

    /**
     * 回复时间
     */
    private Date replyTime;

    public Integer getId() {
        return id;
    }

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
     * @return 问题
     */
    public String getQuestion() {
        return question;
    }

    /**
     * @param question 
	 *            问题
     */
    public void setQuestion(String question) {
        this.question = question == null ? null : question.trim();
    }

    /**
     * @return 提意见时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            提意见时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 回复内容
     */
    public String getAnswer() {
        return answer;
    }

    /**
     * @param answer 
	 *            回复内容
     */
    public void setAnswer(String answer) {
        this.answer = answer == null ? null : answer.trim();
    }

    /**
     * @return 回复人
     */
    public Integer getReplyOperator() {
        return replyOperator;
    }

    /**
     * @param replyOperator 
	 *            回复人
     */
    public void setReplyOperator(Integer replyOperator) {
        this.replyOperator = replyOperator;
    }

    /**
     * @return 回复时间
     */
    public Date getReplyTime() {
        return replyTime;
    }

    /**
     * @param replyTime 
	 *            回复时间
     */
    public void setReplyTime(Date replyTime) {
        this.replyTime = replyTime;
    }
}