/**
 * 
 * OrderQueryPagingVO.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

/**
 * @author huangjiej_2
 * 2015年1月8日 下午10:15:48
 * 本类主要做为十万个为什么相关分页查询vo
 */
public class EncyclopediaQueryPagingVO extends UnionIdQueryPagingVO{

	/**
	 * 构造函数
	 */
	public EncyclopediaQueryPagingVO() {
		
	}
	
	/**
	 * 搜索条件
	 */
	protected String searchKeyword;
	
	/**
	 * 栏目
	 */
	protected Integer channelId;
	
	

	/**
	 * 搜索条件 
	 */
	public String getSearchKeyword() {
		return searchKeyword;
	}

	/**
	 * 搜索条件 
	 */
	public void setSearchKeyword(String searchKeyword) {
		this.searchKeyword = searchKeyword;
	}

	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "EncyclopediaQueryPagingVO [searchKeyword=" + searchKeyword + ", channelId=" + channelId + ", unionId="
				+ unionId + ", mobileNum=" + mobileNum + ", startDate=" + startDate + ", endDate=" + endDate
				+ ", pageSize=" + pageSize + ", pageIndex=" + pageIndex + "]";
	}

	/**
	 * 栏目 
	 */
	public Integer getChannelId() {
		return channelId;
	}

	/**
	 * 栏目 
	 */
	public void setChannelId(Integer channelId) {
		this.channelId = channelId;
	}
	

}
