package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 线上预约
 * @author liudou
 *
 */
public class CandidateAddVO extends AppBaseVO implements Decidable{

	private CandidateAddBodyVO body;

	public CandidateAddBodyVO getBody() {
		return body;
	}

	public void setBody(CandidateAddBodyVO body) {
		this.body = body;
	}
	@Override
	public String toString() {
		return "CandidateAddVO [body=" + body + ", app="
				+ app + "]";
	}
}
