package com.hummingbird.babyspace.controller;

import java.util.ArrayList;
import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.apache.commons.lang.StringUtils;
import org.apache.commons.lang.time.DateUtils;
import org.codehaus.jackson.map.ObjectMapper;
import org.codehaus.jackson.map.SerializationConfig;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.AddCourseOrder;
import com.hummingbird.babyspace.entity.Appointment;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.entity.Child;
import com.hummingbird.babyspace.services.BabyService;
import com.hummingbird.babyspace.services.CourseManagerService;
import com.hummingbird.babyspace.services.CustomerDevService;
import com.hummingbird.babyspace.vo.CandidateAddBodyVO;
import com.hummingbird.babyspace.vo.CandidateAddVO;
import com.hummingbird.babyspace.vo.CourseRecordBodyVO;
import com.hummingbird.babyspace.vo.CourseRecordVO;
import com.hummingbird.babyspace.vo.QueryCourseBodyVO;
import com.hummingbird.babyspace.vo.QueryCourseReturnVO;
import com.hummingbird.babyspace.vo.QueryCourseVO;
import com.hummingbird.babyspace.vo.SpendCourseBodyVO;
import com.hummingbird.babyspace.vo.SpendCourseVO;
import com.hummingbird.common.controller.BaseController;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.util.ValidateUtil;
import com.hummingbird.common.util.http.HttpRequester;
import com.hummingbird.common.vo.ResultModel;

@Controller
@RequestMapping("/courseManager")
public class CourseManagerController extends BaseController{
	@Autowired
	CustomerDevService cusSer;
	@Autowired
	CourseManagerService courManSer;
	@Autowired
	BabyService babySer;
	
	@RequestMapping(value = "/course/query", method = RequestMethod.POST)
	public @ResponseBody Object courseQuery(HttpServletRequest request) {
		

		  QueryCourseVO transorder;
		  ResultModel rm = new ResultModel();
		  try {
		   String jsonstr = RequestUtil.getRequestPostData(request);
		   request.setAttribute("rawjson", jsonstr);
		   transorder = RequestUtil.convertJson2Obj(jsonstr, QueryCourseVO.class);
		  } catch (Exception e) {
		   log.error(String.format("获取订单参数出错"),e);
		   rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
		   return rm;
		  }
		  
		  String messagebase = "查询耗课信息";
		  rm.setBaseErrorCode(29900);
		  rm.setErrmsg(messagebase+"成功");
		  try {
		   //获取url以作为method的内容
		   String requestURI = request.getRequestURI();
		   requestURI=requestURI.replace(request.getContextPath(), "");
		   //备注字段必填
		   PropertiesUtil pu = new PropertiesUtil();
		   //校验
		   ValidateUtil.assertEmpty(transorder.getBody().getUnionId(), "微信Id不能为空");
		   QueryCourseBodyVO body=transorder.getBody();
		   
		   if(log.isDebugEnabled()){
		    log.debug("检验通过，获取请求");
		   }
		   //把这个微信的所有宝宝查出来 babyname
		   List<Child> childs=babySer.queryBabyByUnionId(body.getUnionId(),null);
		   List<QueryCourseReturnVO> list=new ArrayList<QueryCourseReturnVO>();
		   QueryCourseReturnVO detail;
		   for(Child child:childs){
		    List<AddCourseOrder> orders=courManSer.queryAddCourseOrder(child.getId());
		    for(AddCourseOrder order:orders){
		     detail=new QueryCourseReturnVO();
		     detail.setBabyName(child.getBabyName());
		     detail.setChildId(child.getId());
		     if(StringUtils.isBlank(body.getCourseName())){
		      detail.setCourseName(order.getCourseName());
		     }else{
		      detail.setCourseName(body.getCourseName());
		     }
		     detail.setOrderId(order.getOrderId());
		     detail.setCourseNum(body.getCourseNum());
		     list.add(detail);
		     
		    }
		   }
		   rm.put("list", list);
		   
		  } catch (Exception e1) {
		   log.error(String.format(messagebase+"失败"),e1);
		   rm.mergeException(e1);
		   rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		  }
		  
		  
		  return rm;

	}
	
	@RequestMapping(value = "/course/spend", method = RequestMethod.POST)
	public @ResponseBody Object courseSpend(HttpServletRequest request) {
		

		  SpendCourseVO transorder;
		  ResultModel rm = new ResultModel();
		  try {
		   String jsonstr = RequestUtil.getRequestPostData(request);
		   request.setAttribute("rawjson", jsonstr);
		   transorder = RequestUtil.convertJson2Obj(jsonstr, SpendCourseVO.class);
		  } catch (Exception e) {
		   log.error(String.format("获取订单参数出错"),e);
		   rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
		   return rm;
		  }
		  
		  String messagebase = "耗课";
		  rm.setBaseErrorCode(29900);
		  rm.setErrmsg(messagebase+"成功");
		  try {
		   //获取url以作为method的内容
		   String requestURI = request.getRequestURI();
		   requestURI=requestURI.replace(request.getContextPath(), "");
		   //备注字段必填
		   PropertiesUtil pu = new PropertiesUtil();
		   //校验
		  
		   SpendCourseBodyVO body=transorder.getBody();
		   
		   if(log.isDebugEnabled()){
		    log.debug("检验通过，获取请求");
		   }
		   //减去会员课数表的课,记录信息
		  
		   courManSer.spendCourse(body);
		   
		    
		    
		   
		  } catch (Exception e1) {
		   log.error(String.format(messagebase+"失败"),e1);
		   rm.mergeException(e1);
		   rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		  }
		  
		  
		  return rm;

	}
	
	
	@RequestMapping(value = "/course/record", method = RequestMethod.POST)
	public @ResponseBody Object courseRecord(HttpServletRequest request) {
		
		CourseRecordVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, CourseRecordVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "参加活动记录";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			//校验
			ValidateUtil.assertEmpty(transorder.getBody().getUnionId(), "微信Id不能为空");
			CourseRecordBodyVO body=transorder.getBody();
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			//去预约表查询最近的一条预约记录
			List<Appointment> appointments=cusSer.queryAppointments(body.getUnionId());
			//插入记录表
			Integer candidateId=appointments.get(0)==null?null:appointments.get(0).getId();
			courManSer.addAttendAppointment(body, candidateId);
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
}
