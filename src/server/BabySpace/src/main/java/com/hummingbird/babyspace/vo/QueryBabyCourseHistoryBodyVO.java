package com.hummingbird.babyspace.vo;

import com.hummingbird.babyspace.face.Pagingnation;

public class QueryBabyCourseHistoryBodyVO {
	 /*"body":
	    {

	        "unionId":"wzreildknf90454kj434",
	        "orderId":"23487398",
	        "pageIndex":"1",
	        "pageSize":"10"
	    }*/
	private String unionId;
	private String orderId;
	protected Integer pageSize;
	protected Integer pageIndex;
	public String getUnionId() {
		return unionId;
	}
	public void setUnionId(String unionId) {
		this.unionId = unionId;
	}
	public String getOrderId() {
		return orderId;
	}
	public void setOrderId(String orderId) {
		this.orderId = orderId;
	}
	public Integer getPageSize() {
		return pageSize;
	}
	public void setPageSize(Integer pageSize) {
		this.pageSize = pageSize;
	}
	public Integer getPageIndex() {
		return pageIndex;
	}
	public void setPageIndex(Integer pageIndex) {
		this.pageIndex = pageIndex;
	}
	
	public Pagingnation toPagingnation() {
		if(pageIndex<0){
			pageIndex=0;
		}
		if(pageSize<=0){
			pageSize=10;
		}
		if(pageSize>500){
			pageSize=500;
		}
		return  new Pagingnation(pageIndex, pageSize);
	}
	
}
