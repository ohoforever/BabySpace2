package com.hummingbird.babyspace.services;

import com.hummingbird.babyspace.vo.UserQueryBodyVO;
import com.hummingbird.babyspace.vo.UserQueryReturnVO;

public interface UserService {

	public UserQueryReturnVO queryUserInfo(UserQueryBodyVO body);
	
}
