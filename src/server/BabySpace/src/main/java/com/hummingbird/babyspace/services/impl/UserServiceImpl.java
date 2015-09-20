package com.hummingbird.babyspace.services.impl;

import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Member;
import com.hummingbird.babyspace.entity.User;
import com.hummingbird.babyspace.entity.WechatUser;
import com.hummingbird.babyspace.mapper.MemberMapper;
import com.hummingbird.babyspace.mapper.UserMapper;
import com.hummingbird.babyspace.mapper.WechatUserMapper;
import com.hummingbird.babyspace.services.UserService;
import com.hummingbird.babyspace.vo.UserQueryBodyVO;
import com.hummingbird.babyspace.vo.UserQueryReturnVO;
import com.hummingbird.babyspace.vo.UserQueryUserInfoVO;
import com.hummingbird.babyspace.vo.UserQueryWxInfoVO;
import com.hummingbird.common.exception.BusinessException;

@Service
public class UserServiceImpl implements UserService{
	@Autowired
	WechatUserMapper wxUserDao;
	@Autowired
	UserMapper userDao;
	@Autowired
	MemberMapper memberDao;
	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	@Override
	public UserQueryReturnVO queryUserInfo(UserQueryBodyVO body)throws BusinessException {
		//先根据openId查，再根据unionId查
		WechatUser wxUser;
		User user;
		Member member;
		UserQueryReturnVO result=new UserQueryReturnVO();
		UserQueryWxInfoVO wxInfo=new UserQueryWxInfoVO();
		UserQueryUserInfoVO userInfo=new UserQueryUserInfoVO();
		if(StringUtils.isNotBlank(body.getOpenId())){
			wxUser=wxUserDao.selectByOpenId(body.getOpenId());
			if(wxUser!=null){
				wxInfo.setNickname(wxUser.getNickname());
				wxInfo.setOpenid(wxUser.getOpenid());
				wxInfo.setHeadimgurl(wxUser.getHeadimgurl());
				wxInfo.setSubscribe(wxUser.getSubscribe().toString());
				wxInfo.setUnionId(wxUser.getUnionid());
				user=userDao.selectByUnionId(wxUser.getUnionid());
				if(user!=null){
					member=memberDao.selectByUserId(user.getId());
					
					userInfo.setMobileNum(user.getMobileNum());
					userInfo.setName(user.getUserName());
					
					if(member!=null){
						result.setIsMember(true);
					}else{
						result.setIsMember(false);
					}
					result.setUserInfo(userInfo);
				}else{
					result.setIsMember(false);
				}
				
				result.setWxInfo(wxInfo);
				return result;
			}else{
				log.error("用户不存在");
				throw new BusinessException(BusinessException.ERRCODE_REQUEST,"用户不存在");
			}
		}else if(StringUtils.isNotBlank(body.getUnionId())){
			wxUser=wxUserDao.selectByUnionId(body.getUnionId());
			if(wxUser!=null){
				wxInfo.setNickname(wxUser.getNickname());
				wxInfo.setOpenid(wxUser.getOpenid());
				wxInfo.setHeadimgurl(wxUser.getHeadimgurl());
				wxInfo.setSubscribe(wxUser.getSubscribe().toString());
				wxInfo.setUnionId(wxUser.getUnionid());
				user=userDao.selectByUnionId(wxUser.getUnionid());
				if(user!=null){
					member=memberDao.selectByUserId(user.getId());
					
					userInfo.setMobileNum(user.getMobileNum());
					userInfo.setName(user.getUserName());
					
					if(member!=null){
						result.setIsMember(true);
					}else{
						result.setIsMember(false);
					}
					result.setUserInfo(userInfo);
				}else{
					result.setIsMember(false);
				}
				
				result.setWxInfo(wxInfo);
				return result;
			}
			else{
				log.error("用户不存在");
				throw new BusinessException(BusinessException.ERRCODE_REQUEST,"用户不存在");
			}

		}
		
		return null;
	}

}
