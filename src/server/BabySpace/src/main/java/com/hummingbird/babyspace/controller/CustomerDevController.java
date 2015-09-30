package com.hummingbird.babyspace.controller;

import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.apache.commons.lang.time.DateUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.Appointment;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.services.CommonService;
import com.hummingbird.babyspace.services.CourseManagerService;
import com.hummingbird.babyspace.services.CustomerDevService;
import com.hummingbird.babyspace.vo.CandidateAddBodyVO;
import com.hummingbird.babyspace.vo.CandidateAddVO;
import com.hummingbird.babyspace.vo.JudgeAppointmentBodyVO;
import com.hummingbird.babyspace.vo.JudgeAppointmentVO;
import com.hummingbird.babyspace.vo.ShareBodyVO;
import com.hummingbird.babyspace.vo.ShareVO;
import com.hummingbird.common.controller.BaseController;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.util.ValidateUtil;
import com.hummingbird.common.vo.ResultModel;

@Controller
@RequestMapping("/customerDev")
public class CustomerDevController extends BaseController{
	@Autowired
	CustomerDevService cusSer;
	@Autowired
	CommonService commonSer;
	@Autowired
	CourseManagerService courManSer;
	
	@RequestMapping(value = "/candidate/add", method = RequestMethod.POST)
	public @ResponseBody Object addCandidate(HttpServletRequest request) {
		
		CandidateAddVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, CandidateAddVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "新增预约(候选人填报)";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			//校验
			ValidateUtil.validateMobile(transorder.getBody().getMobileNum());
			ValidateUtil.assertEmpty(transorder.getBody().getUnionId(), "微信Id不能为空");
			CandidateAddBodyVO body=transorder.getBody();
			try {
				DateUtils.parseDate(body.getBabyBirthday(),new String[]{ "yyyy-MM-dd"});
			} catch (Exception e) {
				log.error(String.format("宝宝生日非日期格式:"+body.getBabyBirthday()),e);
				throw ValidateException.ERROR_PARAM_FORMAT_ERROR.clone(e,"宝宝生日非日期格式");
			}
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			//插入预约表
			Integer recordId=cusSer.addAppointment(body);
			rm.put("recordId", recordId);
			//查询待开发客户表是否存在相关记录
			List<Candidate> ca=cusSer.queryCandidate(body.getMobileNum());
			if(ca.size()==0){
				cusSer.addCandidate(body);
			}
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	
	
	@RequestMapping(value = "/judgeAppointment", method = RequestMethod.POST)
	public @ResponseBody Object judgeAppointment(HttpServletRequest request) {
		
		JudgeAppointmentVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, JudgeAppointmentVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "确认是否预约";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			ValidateUtil.assertEmpty(transorder.getBody().getUnionId(), "微信Id不能为空");
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			JudgeAppointmentBodyVO body=transorder.getBody();
			//查询预约表
			List<Appointment> appdintments=cusSer.queryAppointments(body.getUnionId());
			if(appdintments.size()==0){
				rm.put("isAppointment", false);
			}else{
				//插入记录表
				Integer candidateId=appdintments.get(0).getId();
				courManSer.addAttendAppointment(null, candidateId);
				rm.put("isAppointment", true);
			}
			
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	@RequestMapping(value = "/share", method = RequestMethod.POST)
	public @ResponseBody Object shareAppointment(HttpServletRequest request) {
		
		ShareVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, ShareVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "预约分享";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			ShareBodyVO body=transorder.getBody();
			ValidateUtil.assertEmpty(body.getUnionId(), "微信Id不能为空");
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			commonSer.share(body.getUnionId(), "APPOI", body.getRecordId());
			
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
}
