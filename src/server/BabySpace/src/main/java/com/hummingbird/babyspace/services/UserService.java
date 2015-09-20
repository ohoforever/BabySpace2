package com.hummingbird.babyspace.services;

import com.hummingbird.babyspace.vo.UserQueryBodyVO;
import com.hummingbird.babyspace.vo.UserQueryReturnVO;
import com.hummingbird.common.exception.BusinessException;

public interface UserService {

	public UserQueryReturnVO queryUserInfo(UserQueryBodyVO body)throws BusinessException;
	
}
