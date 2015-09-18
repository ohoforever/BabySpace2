package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 预约分享
 * @author liudou
 *
 */
public class CustomerDevShareVO extends AppBaseVO implements Decidable{
	private ShareVO body;

	public ShareVO getBody() {
		return body;
	}

	public void setBody(ShareVO body) {
		this.body = body;
	}
	
	@Override
	public String toString() {
		return "CustomerDevShareVO [body=" + body + ", app="
				+ app + "]";
	}
	
}
