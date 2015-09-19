package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;

public class CourseRecordVO extends AppBaseVO implements Decidable{
	private CourseRecordBodyVO body;

	public CourseRecordBodyVO getBody() {
		return body;
	}

	public void setBody(CourseRecordBodyVO body) {
		this.body = body;
	}
	@Override
	public String toString() {
		return "CourseRecordVO [body=" + body + ", app="
				+ app + "]";
	}
}
