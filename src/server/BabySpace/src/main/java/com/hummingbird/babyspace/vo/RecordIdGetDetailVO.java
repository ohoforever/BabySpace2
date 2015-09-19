/**
 * 
 * AdvertisementGetDetailVO.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

/**
 * @author john huang
 * 2015年9月19日 上午7:34:56
 * 本类主要做为 获取记录详情的vo,包含一个recordId和unionId
 */
public class RecordIdGetDetailVO {

	/**
	 * 记录id
	 */
	private Integer recordId;
	/**
	 * 微信号Id
	 */
	private String unionId;
	/**
	 * 记录id 
	 */
	public Integer getRecordId() {
		return recordId;
	}
	/**
	 * 记录id 
	 */
	public void setRecordId(Integer recordId) {
		this.recordId = recordId;
	}
	/**
	 * 微信号Id 
	 */
	public String getUnionId() {
		return unionId;
	}
	/**
	 * 微信号Id 
	 */
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "RecordIdGetDetailVO [recordId=" + recordId + ", unionId=" + unionId + "]";
	}

	
	
}
