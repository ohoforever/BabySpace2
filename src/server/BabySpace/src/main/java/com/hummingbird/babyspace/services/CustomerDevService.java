/**
 * 
 * CustomerDevService.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services;

import java.util.List;

import com.hummingbird.babyspace.entity.Appointment;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.vo.CandidateAddBodyVO;
import com.hummingbird.common.exception.BusinessException;

/**
 * @author john huang
 * 2015年9月18日 下午2:56:28
 * 本类主要做为 客户开发service
 */
public interface CustomerDevService {

	/**
	 * 指定到业务员开发
	 */
	public void assignCancidate2assistant();
	/**
	 * @Description: 新增预约记录
	 * @param body
	 */
	public Integer addAppointment(CandidateAddBodyVO body)throws BusinessException;
	/**
	 * @Description: 查询待开发客户表是否存在该用户
	 * @param mobileNum
	 * @return Candidate
	 */
	public Candidate queryCandidate(String mobileNum);
	/**
	 * @Description: 新增待开发客户
	 * @param body
	 */
	public void addCandidate(CandidateAddBodyVO body)throws BusinessException;
	/**
	 * @Description: 查询没有被使用过的预约
	 * @param body
	 */
	public List<Appointment> queryAppointments(String unionId)throws BusinessException;
	
}
