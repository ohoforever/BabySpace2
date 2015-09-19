package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;

/**
 * @Description: 分享
 * @author liudou
 *
 */
public class ShareVO extends AppBaseVO implements Decidable{
	private ShareBodyVO body;

	public ShareBodyVO getBody() {
		return body;
	}

	public void setBody(ShareBodyVO body) {
		this.body = body;
	}
	@Override
	public String toString() {
		return "ShareVO [body=" + body + ", app="
				+ app + "]";
	}
	
}
