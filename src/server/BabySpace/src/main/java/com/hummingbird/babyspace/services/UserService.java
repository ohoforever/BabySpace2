package com.hummingbird.babyspace.services;

import com.hummingbird.babyspace.entity.User;
import com.hummingbird.babyspace.vo.UserBindBodyVO;
import com.hummingbird.babyspace.vo.UserQueryBodyVO;
import com.hummingbird.babyspace.vo.UserQueryReturnVO;
import com.hummingbird.common.exception.BusinessException;

public interface UserService {

	public UserQueryReturnVO queryUserInfo(UserQueryBodyVO body)throws BusinessException;
	/**
	 * 绑定
	 * @param user
	 * @param body
	 */
	public void Binding(User user,UserBindBodyVO body);
	
}
