/**
 * 
 * BabyInterlocutionSubmitQuestion.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

/**
 * @author john huang
 * 2015年9月19日 下午5:22:34
 * 本类主要做为 提出问题vo
 */
public class BabyInterlocutionSubmitQuestion {

	/**
	 * 微信id
	 */
	protected String unionId;
	/**
	 * 标题
	 */
	protected String title;
	/**
	 * 问题热核
	 */
	protected String desc;
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
	/**
	 * 标题 
	 */
	public String getTitle() {
		return title;
	}
	/**
	 * 标题 
	 */
	public void setTitle(String title) {
		this.title = title;
	}
	/**
	 * 问题热核 
	 */
	public String getDesc() {
		return desc;
	}
	/**
	 * 问题热核 
	 */
	public void setDesc(String desc) {
		this.desc = desc;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "BabyInterlocutionSubmitQuestion [unionId=" + unionId + ", title=" + title + ", desc=" + desc + "]";
	}
	
	
}
