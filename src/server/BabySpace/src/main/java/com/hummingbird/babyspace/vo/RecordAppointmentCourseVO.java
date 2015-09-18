package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 记录预约试听
 * @author liudou
 *
 */
public class RecordAppointmentCourseVO extends AppBaseVO implements Decidable{
	private RecordAppointmentBodyVO body;

	public RecordAppointmentBodyVO getBody() {
		return body;
	}

	public void setBody(RecordAppointmentBodyVO body) {
		this.body = body;
	}
	@Override
	public String toString() {
		return "RecordAppointmentCourseVO [body=" + body + ", app="
				+ app + "]";
	}
}
