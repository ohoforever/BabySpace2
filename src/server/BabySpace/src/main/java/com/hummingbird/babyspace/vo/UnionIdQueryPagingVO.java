/**
 * 
 * OrderQueryPagingVO.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.PagingnationVO;

/**
 * @author huangjiej_2
 * 2015年1月8日 下午10:15:48
 * 本类主要做为微信号相关分页查询vo,其它类不同的查询条件可以在此类的基础上进行扩展
 */
public class UnionIdQueryPagingVO extends PagingnationVO{

	/**
	 * 构造函数
	 */
	public UnionIdQueryPagingVO() {
		
	}
	
	/**
	 * 微信号
	 */
	protected String unionId;
	protected String mobileNum;
	
	protected String startDate;
	
	protected String endDate;

	/**
	 * @return the mobileNum
	 */
	public String getMobileNum() {
		return mobileNum;
	}

	/**
	 * @param mobileNum the mobileNum to set
	 */
	public void setMobileNum(String mobileNum) {
		this.mobileNum = mobileNum;
	}

	/**
	 * @return the startDate
	 */
	public String getStartDate() {
		return startDate;
	}

	/**
	 * @param startDate the startDate to set
	 */
	public void setStartDate(String startDate) {
		this.startDate = startDate;
	}

	/**
	 * @return the endDate
	 */
	public String getEndDate() {
		return endDate;
	}

	/**
	 * @param endDate the endDate to set
	 */
	public void setEndDate(String endDate) {
		this.endDate = endDate;
	}

	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "UnionIdQueryPagingVO [unionId=" + unionId + ", mobileNum=" + mobileNum + ", startDate=" + startDate
				+ ", endDate=" + endDate + "]";
	}

	/**
	 * 微信号 
	 */
	public String getUnionId() {
		return unionId;
	}

	/**
	 * 微信号 
	 */
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	
	
	

}
