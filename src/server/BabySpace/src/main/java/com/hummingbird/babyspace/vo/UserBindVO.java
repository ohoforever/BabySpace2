package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 用户绑定
 * @author liudou
 *
 */
public class UserBindVO extends AppBaseVO implements Decidable{
	private UserBindBodyVO body;

	public UserBindBodyVO getBody() {
		return body;
	}

	public void setBody(UserBindBodyVO body) {
		this.body = body;
	}

	@Override
	public String toString() {
		return "UserBindVO [body=" + body + ", app="
				+ app + "]";
	}
	
}
