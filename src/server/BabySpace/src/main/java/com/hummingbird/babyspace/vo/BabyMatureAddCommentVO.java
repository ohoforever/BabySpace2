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
public class BabyMatureAddCommentVO extends AddCommentVO {

	/**
	 * 回复id 
	 */
	public Integer getMatureId() {
		return getRecordId();
	}
	/**
	 * 回复id 
	 */
	public void setMatureId(Integer matureId) {
		setRecordId(matureId);
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "BabyMatureAddCommentVO [unionId=" + unionId + ", comment=" + comment + ", replyTo=" + replyTo
				+ ", recordId=" + recordId + ", getMatureId()=" + getMatureId() + "]";
	}
	
	
}
