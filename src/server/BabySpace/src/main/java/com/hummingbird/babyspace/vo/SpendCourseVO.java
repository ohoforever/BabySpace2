package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;

/**
 * @Description: 耗课
 * @author liudou
 *
 */
public class SpendCourseVO extends AppBaseVO implements Decidable{
	private SpendCourseBodyVO body;

	public SpendCourseBodyVO getBody() {
		return body;
	}

	public void setBody(SpendCourseBodyVO body) {
		this.body = body;
	}
	
	public String toString() {
		return "SpendCourseBodyVO [body=" + body + ", app="
				+ app + "]";
	}
	
}
