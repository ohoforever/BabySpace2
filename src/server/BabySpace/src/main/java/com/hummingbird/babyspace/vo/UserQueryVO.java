package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 用户信息查询
 * @author liudou
 *
 */
public class UserQueryVO extends AppBaseVO implements Decidable{
	private UserQueryBodyVO body;

	public UserQueryBodyVO getBody() {
		return body;
	}

	public void setBody(UserQueryBodyVO body) {
		this.body = body;
	}
	
	@Override
	public String toString() {
		return "UserQueryVO [body=" + body + ", app="
				+ app + "]";
	}
}
