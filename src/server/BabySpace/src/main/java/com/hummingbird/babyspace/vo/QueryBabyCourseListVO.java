package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 查询要消耗的课程信息
 * @author liudou
 *
 */
public class QueryBabyCourseListVO extends AppBaseVO implements Decidable{
	private QueryBabyCourseListBodyVO body;

	public QueryBabyCourseListBodyVO getBody() {
		return body;
	}

	public void setBody(QueryBabyCourseListBodyVO body) {
		this.body = body;
	}
	public String toString() {
		return "QueryBabyCourseListVO [body=" + body + ", app="
				+ app + "]";
	}
}
