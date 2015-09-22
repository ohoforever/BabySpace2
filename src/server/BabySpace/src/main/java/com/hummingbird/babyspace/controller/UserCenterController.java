package com.hummingbird.babyspace.controller;

import java.util.Date;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.User;
import com.hummingbird.babyspace.entity.WechatUser;
import com.hummingbird.babyspace.mapper.UserMapper;
import com.hummingbird.babyspace.mapper.WechatUserMapper;
import com.hummingbird.babyspace.services.CommonService;
import com.hummingbird.babyspace.services.CustomerDevService;
import com.hummingbird.babyspace.services.UserService;
import com.hummingbird.babyspace.vo.ShareBodyVO;
import com.hummingbird.babyspace.vo.ShareVO;
import com.hummingbird.babyspace.vo.UserBindBodyVO;
import com.hummingbird.babyspace.vo.UserBindVO;
import com.hummingbird.babyspace.vo.UserQueryBodyVO;
import com.hummingbird.babyspace.vo.UserQueryReturnVO;
import com.hummingbird.babyspace.vo.UserQueryVO;
import com.hummingbird.babyspace.vo.UserRegBodyVO;
import com.hummingbird.babyspace.vo.UserRegVO;
import com.hummingbird.common.controller.BaseController;
import com.hummingbird.common.exception.BusinessException;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.util.ValidateUtil;
import com.hummingbird.common.vo.ResultModel;

@Controller
@RequestMapping("/userCenter")
public class UserCenterController extends BaseController{
	@Autowired
	CustomerDevService cusSer;
	@Autowired
	CommonService commonSer;
	@Autowired
	UserService userSer;
	@Autowired
	WechatUserMapper wxUserDao;
	@Autowired
	UserMapper userDao;
	
	@RequestMapping(value = "/user/query", method = RequestMethod.POST)
	public @ResponseBody Object queryUserInfo(HttpServletRequest request) {
		
		UserQueryVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, UserQueryVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "查询用户信息";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			UserQueryBodyVO body=transorder.getBody();
			
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			
			UserQueryReturnVO result=userSer.queryUserInfo(body);
			rm.put("result", result);
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	
	@RequestMapping(value = "/info/save", method = RequestMethod.POST)
	public @ResponseBody Object register(HttpServletRequest request) {
		
		UserRegVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, UserRegVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "保存用户信息";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			UserRegBodyVO body=transorder.getBody();
			
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			WechatUser wxUser=wxUserDao.selectByOpenId(body.getOpenid());
			if(wxUser==null){
				wxUser=new WechatUser();
				wxUser.setOpenid(body.getOpenid());
				wxUser.setNickname(body.getNickname());
				wxUser.setSex(Byte.valueOf(body.getSex()));
				wxUser.setLanguage(body.getLanguage());
				wxUser.setCity(body.getCity());
				wxUser.setProvince(body.getProvince());
				wxUser.setCountry(body.getCountry());
				wxUser.setHeadimgurl(body.getHeadimgurl());
				wxUser.setSubscribeTime(Integer.valueOf(body.getSubscribe_time()));
				wxUser.setUnionid(body.getUnionid());
				wxUser.setRemark(body.getRemark());
				wxUser.setSubscribe(Byte.valueOf(body.getSubscribe()));
				wxUser.setGroupid(Integer.valueOf(body.getGroupid()));
				wxUser.setPrivilege(body.getPrivilege());
				wxUserDao.insert(wxUser);
			}else{
				wxUser.setOpenid(body.getOpenid());
				wxUser.setNickname(body.getNickname());
				wxUser.setSex(Byte.valueOf(body.getSex()));
				wxUser.setLanguage(body.getLanguage());
				wxUser.setCity(body.getCity());
				wxUser.setProvince(body.getProvince());
				wxUser.setCountry(body.getCountry());
				wxUser.setHeadimgurl(body.getHeadimgurl());
				wxUser.setSubscribeTime(Integer.valueOf(body.getSubscribe_time()));
				wxUser.setUnionid(body.getUnionid());
				wxUser.setRemark(body.getRemark());
				wxUser.setSubscribe(Byte.valueOf(body.getSubscribe()));
				wxUser.setGroupid(Integer.valueOf(body.getGroupid()));
				wxUser.setPrivilege(body.getPrivilege());
				wxUserDao.updateByPrimaryKey(wxUser);
			}
			
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败,"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	
	@RequestMapping(value = "/user/bind", method = RequestMethod.POST)
	public @ResponseBody Object bind(HttpServletRequest request) {
		
		UserBindVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, UserBindVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "绑定";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			ValidateUtil.assertEmpty(transorder.getBody().getUnionId(), "微信Id不能为空");
			ValidateUtil.validateMobile(transorder.getBody().getMobileNum());
			
			PropertiesUtil pu = new PropertiesUtil();
			UserBindBodyVO body=transorder.getBody();
			
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			WechatUser wxUser=wxUserDao.selectByUnionId(body.getUnionId());
			if(wxUser==null){
				log.error(String.format("根据unionId[%s]查不到微信记录", body.getUnionId()));
				throw new BusinessException(BusinessException.ERRCODE_REQUEST,"微信用户不存在");
			}else{
				User user=userDao.selectByUnionId(body.getUnionId());
				if(user==null){
					log.error("用户不存在");
					throw new BusinessException(BusinessException.ERRCODE_REQUEST,"用户不存在");
				}else{
					userSer.Binding(user, body);
				}
			}
			
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	
}
