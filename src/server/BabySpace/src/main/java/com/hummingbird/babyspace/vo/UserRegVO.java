package com.hummingbird.babyspace.vo;

import com.hummingbird.commonbiz.vo.AppBaseVO;
import com.hummingbird.commonbiz.vo.Decidable;
/**
 * @Description: 用户注册接口
 * @author liudou
 *
 */
public class UserRegVO extends AppBaseVO implements Decidable{
	private UserRegBodyVO body;

	public UserRegBodyVO getBody() {
		return body;
	}

	public void setBody(UserRegBodyVO body) {
		this.body = body;
	}
	@Override
	public String toString() {
		return "UserRegVO [body=" + body + ", app="
				+ app + "]";
	}
}
