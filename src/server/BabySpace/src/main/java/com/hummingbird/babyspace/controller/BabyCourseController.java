package com.hummingbird.babyspace.controller;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import javax.servlet.http.HttpServletRequest;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.AddCourseOrder;
import com.hummingbird.babyspace.entity.Appointment;
import com.hummingbird.babyspace.entity.Child;
import com.hummingbird.babyspace.face.Pagingnation;
import com.hummingbird.babyspace.services.BabyService;
import com.hummingbird.babyspace.services.CourseManagerService;
import com.hummingbird.babyspace.vo.CourseRecordBodyVO;
import com.hummingbird.babyspace.vo.CourseRecordVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryBodyVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryDetailReturnVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryListVO;
import com.hummingbird.babyspace.vo.QueryBabySpendCourseDetailReturnVO;
import com.hummingbird.babyspace.vo.QueryBabySpendCourseListBodyVO;
import com.hummingbird.babyspace.vo.QueryBabySpendCourseListVO;
import com.hummingbird.common.controller.BaseController;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.util.DateUtil;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.util.ValidateUtil;
import com.hummingbird.common.vo.ResultModel;

@Controller
@RequestMapping("/babyCourse")
public class BabyCourseController extends BaseController{
	@Autowired
	BabyService babySer;
	@Autowired
	CourseManagerService courseSer;
	
	@RequestMapping(value = "/course/queryBabyCourseList", method = RequestMethod.POST)
	public @ResponseBody Object queryBabyCourseList(HttpServletRequest request) {
		
		QueryBabySpendCourseListVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, QueryBabySpendCourseListVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "查询宝宝课程";
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
			QueryBabySpendCourseListBodyVO body=transorder.getBody();
			
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			List<QueryBabySpendCourseDetailReturnVO> list=new ArrayList<QueryBabySpendCourseDetailReturnVO>();
			//把这个微信的所有宝宝查出来 babyname
			List<Child> childs=babySer.queryBabyByUnionId(body.getUnionId(),null);
			//根据宝宝Id查报课信息courseName orderId 
			QueryBabySpendCourseDetailReturnVO detail;
			for(Child child:childs){
				List<AddCourseOrder> orders=courseSer.queryAddCourseOrder(child.getId());
				for(AddCourseOrder order:orders){
					detail=new QueryBabySpendCourseDetailReturnVO();
					detail.setBabyName(child.getBabyName());
					detail.setCourseName(order.getCourseName());
					detail.setSchoolName(order.getSchoolName());
					detail.setOrderId(order.getOrderId());
					//根据报课Id查更新时间和剩余课程updateTime courseCount
					detail.setUpdateTime(DateUtil.formatCommonDateorNull(order.getInsertTime()));
					
					//剩余课时数
					Integer courseCount=order.getCourseTotal()-courseSer.queryCourseCount(order.getOrderId());
					detail.setCourseCount(courseCount);
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
	
	@RequestMapping(value = "/queryBabyCourseHistoryList", method = RequestMethod.POST)
	public @ResponseBody Object queryBabyCourseHistoryList(HttpServletRequest request) {
		
		QueryBabyCourseHistoryListVO transorder;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, QueryBabyCourseHistoryListVO.class);
		} catch (Exception e) {
			log.error(String.format("获取订单参数出错"),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, "订单参数"));
			return rm;
		}
		
		String messagebase = "查询宝宝耗课历史";
		rm.setBaseErrorCode(29900);
		rm.setErrmsg(messagebase+"成功");
		try {
			//获取url以作为method的内容
			String requestURI = request.getRequestURI();
			requestURI=requestURI.replace(request.getContextPath(), "");
			//备注字段必填
			PropertiesUtil pu = new PropertiesUtil();
			//校验
			
			QueryBabyCourseHistoryBodyVO body=transorder.getBody();
			Pagingnation pagingnation = body.toPagingnation();
			if(log.isDebugEnabled()){
				log.debug("检验通过，获取请求");
			}
			List<QueryBabyCourseHistoryDetailReturnVO> list=courseSer.queryAttendClass(body,pagingnation);
			rm.put("pageSize", pagingnation.getPageSize());
			rm.put("pageIndex", pagingnation.getCurrPage());
			rm.put("total", pagingnation.getTotalCount());
			rm.put("list", list);
			
			
		} catch (Exception e1) {
			log.error(String.format(messagebase+"失败"),e1);
			rm.mergeException(e1);
			rm.setErrmsg(messagebase+"失败，"+rm.getErrmsg());
		}
		
		
		return rm;
	}
	
}
