/**
 * 
 * BabyInterlocutionSubmitQuestion.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

/**
 * @author john huang
 * 2015年9月19日 下午5:22:34
 * 本类主要做为 添加评论vo
 */
public class AddCommentVO {

	/**
	 * 微信id
	 */
	protected String unionId;
	/**
	 * 评论内容
	 */
	protected String comment;
	/**
	 * 回复id
	 */
	protected Integer replyTo;
	/**
	 * 记录Id
	 */
	protected Integer recordId;
	/**
	 * 微信id 
	 */
	public String getUnionId() {
		return unionId;
	}
	/**
	 * 微信id 
	 */
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "AddCommentVO [unionId=" + unionId + ", comment=" + comment + ", replyTo=" + replyTo + ", recordId="
				+ recordId + "]";
	}
	/**
	 * 评论内容 
	 */
	public String getComment() {
		return comment;
	}
	/**
	 * 评论内容 
	 */
	public void setComment(String comment) {
		this.comment = comment;
	}
	/**
	 * 回复id 
	 */
	public Integer getReplyTo() {
		return replyTo;
	}
	/**
	 * 回复id 
	 */
	public void setReplyTo(Integer replyTo) {
		this.replyTo = replyTo;
	}
	/**
	 * 记录Id 
	 */
	public Integer getRecordId() {
		return recordId;
	}
	/**
	 * 记录Id 
	 */
	public void setRecordId(Integer recordId) {
		this.recordId = recordId;
	}
	
	
}
