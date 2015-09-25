package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Child;
import com.hummingbird.babyspace.entity.User;
import com.hummingbird.babyspace.mapper.ChildMapper;
import com.hummingbird.babyspace.mapper.UserMapper;
import com.hummingbird.babyspace.services.BabyService;
@Service
public class BabyServiceImpl implements BabyService{
@Autowired
ChildMapper childDao;
@Autowired
UserMapper userDao;
	@Override
	public List<Child> queryBabyByUnionId(String unionId,String mobileNum) {
		User user=null;
		if(StringUtils.isNotBlank(unionId)){
			user=userDao.selectByUnionId(unionId);
		}else if(StringUtils.isNotBlank(mobileNum)){
			user=userDao.selectByMobileNum(mobileNum);
		}
		if(user!=null){
			List<Child> childs=childDao.selectByUserId(user.getId());
			return childs;
		}
		return null;
	}

}
