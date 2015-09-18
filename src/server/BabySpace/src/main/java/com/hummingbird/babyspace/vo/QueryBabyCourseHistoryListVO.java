package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 宝宝的培训课程历史接口
 * @author liudou
 *
 */
public class QueryBabyCourseHistoryListVO extends AppBaseVO implements Decidable{
	private QueryBabyCourseHistoryBodyVO body;

	public QueryBabyCourseHistoryBodyVO getBody() {
		return body;
	}

	public void setBody(QueryBabyCourseHistoryBodyVO body) {
		this.body = body;
	}
	
}
