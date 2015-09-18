package com.hummingbird.babyspace.vo;

import java.util.List;
/**
 * @Description: 查询要消耗的课程信息
 * @author liudou
 *
 */
public class QueryBabyCourseListReturnVO {
	/*{
    "errcode":0000,"errmsg":"查询消耗课程成功",
	"list":[{
	   "babyName":"蚯蚓",
	   "childId":645,
	   "courseName":"音律",
	   "orderId":"43647",
	   "courseNum":2
	},{
	   "babyName":"蚯蚓2",
	   "childId":625,
	   "courseName":"音律",
	   "orderId":"43647",
	   "courseNum":2
	}]
	}*/
	private Integer pageSize;
	private Integer pageIndex;
	private Integer total;
	private List<QueryBabyCourseDetailReturnVO> list;
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
	public List<QueryBabyCourseDetailReturnVO> getList() {
		return list;
	}
	public void setList(List<QueryBabyCourseDetailReturnVO> list) {
		this.list = list;
	}
	
}
