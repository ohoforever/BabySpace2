package com.hummingbird.babyspace.vo;

import com.hummingbird.babyspace.face.Pagingnation;

public class QueryBabySpendCourseListBodyVO {
	private String unionId;
	private String mobileNum;
	
	protected Integer pageSize;
	protected Integer pageIndex;
	
	public String getMobileNum() {
		return mobileNum;
	}
	public void setMobileNum(String mobileNum) {
		this.mobileNum = mobileNum;
	}
	public String getUnionId() {
		return unionId;
	}
	public void setUnionId(String unionId) {
		this.unionId = unionId;
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
