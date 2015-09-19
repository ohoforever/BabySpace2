package com.hummingbird.babyspace.vo;

import java.util.List;
/**
 * @Description:查询宝宝已耗课历史
 * @author liudou
 *
 */
public class QueryBabySpendCourseReturnVO {
	/*{"errcode":0,"errmsg":"查询宝宝课程状态成功",
        "list":[{
		    "courseName":"幼儿心理",
		    "orderId":"23487398",
		    "babyName":"宝宝名字",
		    "updateTime":"2015-09-01 01:21:54",
		    "courseCount":"10"
		    },{
		    "courseName":"幼儿快乐成长",
		    "orderId":"23487388",
		    "babyName":"宝宝名字",
		    "updateTime":"2015-08-01 01:21:54",
		    "courseCount":"11"
		    }]
		}*/
	private Integer pageSize;
	private Integer pageIndex;
	private Integer total;
	private List<QueryBabySpendCourseDetailReturnVO> list;
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
	public List<QueryBabySpendCourseDetailReturnVO> getList() {
		return list;
	}
	public void setList(List<QueryBabySpendCourseDetailReturnVO> list) {
		this.list = list;
	}
	
}
