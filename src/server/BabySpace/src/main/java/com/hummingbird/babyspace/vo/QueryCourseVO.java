package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;

/**
 * 确认耗课
 * @author liudou
 *
 */
public class QueryCourseVO  extends AppBaseVO implements Decidable{
	private QueryCourseBodyVO body;
	
	public QueryCourseBodyVO getBody() {
		return body;
	}
	
	public void setBody(QueryCourseBodyVO body) {
		this.body = body;
	}

}
