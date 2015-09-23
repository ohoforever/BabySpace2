package com.hummingbird.babyspace.services;

import java.util.List;

import com.hummingbird.babyspace.entity.AddCourseOrder;
import com.hummingbird.babyspace.entity.AttendClass;
import com.hummingbird.babyspace.face.Pagingnation;
import com.hummingbird.babyspace.vo.CourseRecordBodyVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryBodyVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryDetailReturnVO;
import com.hummingbird.babyspace.vo.QueryBabyCourseHistoryReturnVO;
import com.hummingbird.babyspace.vo.SpendCourseBodyVO;
import com.hummingbird.common.exception.BusinessException;

public interface CourseManagerService {
	/**
	 * @Description 添加试听记录
	 * @param body
	 */
	public void addAttendAppointment(CourseRecordBodyVO body,Integer candidateId);
	/**
	 * 根据宝宝查课程
	 * @param childId
	 * @return
	 */
	public List<AddCourseOrder> queryAddCourseOrder(Integer childId);
	/**
	 * 根据课程查询消耗的课时
	 * @param orderId
	 * @return
	 */
	public Integer queryCourseCount(String orderId);
	/**
	 * 查询耗课历史记录
	 * @param body
	 * @param page
	 * @return
	 */
	public List<QueryBabyCourseHistoryDetailReturnVO> queryAttendClass(QueryBabyCourseHistoryBodyVO body,Pagingnation page);

	/**
	 * 耗课
	 * @param body
	 */
	public void spendCourse(SpendCourseBodyVO body) throws BusinessException;
	
	public void subUserCourse(Integer CourseCount,Integer childId)throws BusinessException;
}
