package com.hummingbird.babyspace.services.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.apache.commons.lang.StringUtils;
import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Propagation;
import org.springframework.transaction.annotation.Transactional;

import com.hummingbird.babyspace.entity.AddCourseOrder;
import com.hummingbird.babyspace.entity.AttendAppointment;
import com.hummingbird.babyspace.entity.AttendClass;
import com.hummingbird.babyspace.entity.AttendClassHistory;
import com.hummingbird.babyspace.entity.Child;
import com.hummingbird.babyspace.entity.UserCourses;
import com.hummingbird.babyspace.face.Pagingnation;
import com.hummingbird.babyspace.mapper.AddCourseOrderMapper;
import com.hummingbird.babyspace.mapper.AttendAppointmentMapper;
import com.hummingbird.babyspace.mapper.AttendClassHistoryMapper;
import com.hummingbird.babyspace.mapper.AttendClassMapper;
import com.hummingbird.babyspace.mapper.ChildMapper;
import com.hummingbird.babyspace.mapper.UserCoursesMapper;
import com.hummingbird.babyspace.services.CourseManagerService;
import com.hummingbird.babyspace.vo.CourseRecordBodyVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryBodyVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryDetailReturnVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryReturnVO;
import com.hummingbird.babyspace.vo.SpendCourseBodyVO;
import com.hummingbird.common.exception.BusinessException;
import com.hummingbird.common.util.DateUtil;
@Service
public class CourseManagerServiceimpl implements CourseManagerService{
	protected  final Log log = LogFactory.getLog(getClass());
	@Autowired 
	AttendAppointmentMapper attendDao;
	@Autowired
	AddCourseOrderMapper addCourOrderDao;
	@Autowired
	AttendClassHistoryMapper attendClassHistoryDao;
	@Autowired
	AttendClassMapper attendClassDao;
	@Autowired
	UserCoursesMapper userCoursesDao;
	@Autowired
	ChildMapper childDao;
	
	@Override
	public void addAttendAppointment(String courseName,Integer candidateId) {
		AttendAppointment attend=new AttendAppointment();
		attend.setCandidateId(candidateId);
		attend.setCourseName(courseName);
		attend.setInsertTime(new Date());
		attendDao.insert(attend);
	}
	@Override
	public List<AddCourseOrder> queryAddCourseOrder(Integer childId) {
		
		return addCourOrderDao.selectByChildId(childId);
	}
	@Override
	public Integer queryCourseCount(String orderId) {
		// TODO Auto-generated method stub
		return attendClassDao.queryCourseCount(orderId);
	}
	
	@Override
	public List<QueryBabyCourseHistoryDetailReturnVO> queryAttendClass(
			QueryBabyCourseHistoryBodyVO body, Pagingnation page) {
		List<QueryBabyCourseHistoryDetailReturnVO> list=new ArrayList<QueryBabyCourseHistoryDetailReturnVO>();
		QueryBabyCourseHistoryDetailReturnVO history;
		page.setTotalCount(attendClassDao.queryAddCourseOrderTotal(body.getOrderId()));
		page.calculatePageCount();
		List<AttendClass> attends=attendClassDao.queryAddCourseOrder(body.getOrderId(),page);
		for(AttendClass attend:attends){
			history=new QueryBabyCourseHistoryDetailReturnVO();
			history.setAttendTime(DateUtil.formatCommonDateorNull(attend.getActTime()));
			history.setBabyName(body.getBabyName());
			history.setClassName(attend.getClassname());
			history.setCourseCount(attend.getCourseCount());
			history.setSchoolName(body.getSchoolName());
			list.add(history);
		}
		
		
		return list;
	}
	@Override
	@Transactional(propagation=Propagation.REQUIRED,rollbackFor=Exception.class,value="txManager")
	public void spendCourse(SpendCourseBodyVO body) throws BusinessException {
		//查询用户并减去用户课数
		Child child=childDao.selectByPrimaryKey(body.getChildId());
		if(child==null){
			log.error(String.format("根据childId【%s】查询宝宝信息失败", body.getChildId()));
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,String.format("根据childId【%s】查询宝宝信息失败", body.getChildId()));
		}
		try {
			subUserCourse(body.getCourseNum(),child.getUserId());
		} catch (BusinessException e) {
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,e.getMessage());
		}
		AddCourseOrder order= addCourOrderDao.selectByPrimaryKey(body.getOrderId());
		if(order==null){
			log.error(String.format("订单【%s】不存在", body.getOrderId()));
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,String.format("订单【%s】不存在", body.getOrderId()));
		}
		//当前剩余课时数
		Integer courseCount=order.getCourseCount()+order.getGivenCount()-queryCourseCount(order.getOrderId())-body.getCourseNum();
		if(courseCount<0){
			log.error("课程数不够");
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,"课程数不够,耗课失败");
		}
		if(0==courseCount){
			order.setStatus("END");
			addCourOrderDao.updateByPrimaryKey(order);
		}
		AttendClass attend=new AttendClass();
		attend.setActTime(new Date());
		attend.setChildId(body.getChildId());
		attend.setClassname(body.getCourseName());
		attend.setCourseCount(body.getCourseNum());
		attend.setOperator(body.getOperator());
		attend.setInsertTime(new Date());
		attend.setLeftCourseCount(courseCount);
		attend.setOrderId(body.getOrderId());
		attend.setStatus("OK#");
		attend.setUpdateTime(new Date());
		//插入上课表并获取记录id
		Integer attendId=attendClassDao.insertAndGetId(attend);
		
		
		AttendClassHistory history=new AttendClassHistory();
		history.setActTime(new Date());
		history.setAttendId(attendId);
		history.setChildId(body.getChildId());
		history.setClassname(body.getCourseName());
		history.setCourseCount(body.getCourseNum());
		history.setInsertTime(new Date());
		history.setLeftCourseCount(courseCount);
		history.setType("ADD");
		history.setOperator(body.getOperator());
		history.setOrderId(body.getOrderId());
		history.setStatus("OK#");
		history.setUpdateTime(new Date());
		//插入历史表
		attendClassHistoryDao.insert(history);
	}
	@Override
	public void subUserCourse(Integer CourseCount,Integer userId) throws BusinessException{
		// TODO Auto-generated method stub
		
		UserCourses userCourses=userCoursesDao.selectByPrimaryKey(userId);
		if((userCourses.getCourseLeft()-CourseCount)<0){
			log.error("剩余课时不足，耗课失败");
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,"剩余课时不足，耗课失败");
		}
		userCourses.setCourseLeft(userCourses.getCourseLeft()-CourseCount);
		userCourses.setUpdateTime(new Date());
		userCoursesDao.updateByPrimaryKey(userCourses);
	}

}
