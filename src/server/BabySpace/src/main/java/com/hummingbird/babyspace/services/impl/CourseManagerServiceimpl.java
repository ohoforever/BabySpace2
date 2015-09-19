package com.hummingbird.babyspace.services.impl;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.AddCourseOrder;
import com.hummingbird.babyspace.entity.AttendAppointment;
import com.hummingbird.babyspace.entity.AttendClass;
import com.hummingbird.babyspace.entity.UserCourses;
import com.hummingbird.babyspace.face.Pagingnation;
import com.hummingbird.babyspace.mapper.AddCourseOrderMapper;
import com.hummingbird.babyspace.mapper.AttendAppointmentMapper;
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
	AttendClassMapper attendClassDao;
	@Autowired
	UserCoursesMapper userCoursesDao;
	@Autowired
	ChildMapper childDao;
	
	@Override
	public void addAttendAppointment(CourseRecordBodyVO body,Integer candidateId) {
		AttendAppointment attend=new AttendAppointment();
		attend.setCandidateId(candidateId);
		attend.setCourseName(body.getCourseName());
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
		List<AttendClass> attends=attendClassDao.queryAddCourseOrder(body.getOrderId(),page);
		for(AttendClass attend:attends){
			history=new QueryBabyCourseHistoryDetailReturnVO();
			history.setAttendTime(DateUtil.formatCommonDateorNull(attend.getInsertTime()));
			history.setBabyName(body.getBabyName());
			history.setClassName(attend.getClassname());
			history.setCourseCount(attend.getCourseCount());
			history.setSchoolName(body.getSchoolName());
			list.add(history);
		}
		
		
		return list;
	}
	@Override
	public void spendCourse(SpendCourseBodyVO body) {
		AttendClass attend=new AttendClass();
		attend.setActTime(new Date());
		attend.setChildId(body.getChildId());
		attend.setClassname(body.getCourseName());
		attend.setCourseCount(body.getCourseNum());
		attend.setInsertTime(new Date());
		attend.setOrderId(body.getOrderId());
		attend.setStatus("OK#");
		attend.setUpdateTime(new Date());
		attendClassDao.insert(attend);
	}
	@Override
	public void subUserCourse(Integer CourseCount,Integer childId) throws BusinessException{
		// TODO Auto-generated method stub
		int userId=childDao.selectUserIdByChildId(childId);
		UserCourses userCourses=userCoursesDao.selectByPrimaryKey(userId);
		if((userCourses.getCourseLeft()-CourseCount)<=0){
			log.error("剩余课时不足，耗课失败");
			throw new BusinessException(BusinessException.ERRCODE_REQUEST,"剩余课时不足，耗课失败");
		}
		userCourses.setCourseLeft(userCourses.getCourseLeft()-CourseCount);
		userCourses.setUpdateTime(new Date());
		userCoursesDao.updateByPrimaryKey(userCourses);
	}

}
