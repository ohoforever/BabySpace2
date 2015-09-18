package com.hummingbird.babyspace.vo;

import java.util.List;

public class QueryBabyCourseHistoryReturnVO {
	/*{"errcode":0,"errmsg":"获取宝宝课程历史列表成功","pageSize":10,"pageIndex":0,"total":100,
        "list":[{
		    "schoolName":"白云校区",
		    "courseName":"幼儿教育",
		    "babyName":"蚯蚓",
		    "courseCount":"1",
		    "attendTime":"2015-02-01 14:55:09"
		    }]
		}*/
	private Integer pageSize;
	private Integer pageIndex;
	private Integer total;
	private List<QueryBabyCourseHistoryDetailReturnnVO> list;
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
	public Integer getTotal() {
		return total;
	}
	public void setTotal(Integer total) {
		this.total = total;
	}
	public List<QueryBabyCourseHistoryDetailReturnnVO> getList() {
		return list;
	}
	public void setList(List<QueryBabyCourseHistoryDetailReturnnVO> list) {
		this.list = list;
	}
	
}
