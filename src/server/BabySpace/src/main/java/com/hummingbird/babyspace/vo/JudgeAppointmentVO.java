package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 查看是否预约
 * @author liudou
 *
 */
public class JudgeAppointmentVO  extends AppBaseVO implements Decidable{
	private JudgeAppointmentBodyVO body;

	public JudgeAppointmentBodyVO getBody() {
		return body;
	}

	public void setBody(JudgeAppointmentBodyVO body) {
		this.body = body;
	}
	public String toString() {
		return "JudgeAppointmentVO [body=" + body + ", app="
				+ app + "]";
	}
}
