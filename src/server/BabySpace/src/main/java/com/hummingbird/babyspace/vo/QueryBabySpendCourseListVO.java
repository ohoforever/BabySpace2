package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 查询耗课历史列表
 * @author liudou
 *
 */
public class QueryBabySpendCourseListVO extends AppBaseVO implements Decidable{
	private QueryBabySpendCourseListBodyVO body;

	public QueryBabySpendCourseListBodyVO getBody() {
		return body;
	}
	
	public void setBody(QueryBabySpendCourseListBodyVO body) {
		this.body = body;
	}

	@Override
	public String toString() {
		return "QueryBabySpendCourseListVO [body=" + body + ", app="
				+ app + "]";
	}
}
