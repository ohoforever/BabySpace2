/**
 * 
 * CustomerDevServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.text.ParseException;
import java.util.Date;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Propagation;
import org.springframework.transaction.annotation.Transactional;

import com.hummingbird.babyspace.entity.Appointment;
import com.hummingbird.babyspace.entity.Assistant;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.entity.CandidateDevelop;
import com.hummingbird.babyspace.mapper.AppointmentMapper;
import com.hummingbird.babyspace.mapper.AssistantDevelopCountMapper;
import com.hummingbird.babyspace.mapper.CandidateDevelopMapper;
import com.hummingbird.babyspace.mapper.CandidateMapper;
import com.hummingbird.babyspace.services.CustomerDevService;
import com.hummingbird.babyspace.vo.CandidateAddBodyVO;
import com.hummingbird.common.exception.BusinessException;
import com.hummingbird.common.util.DateUtil;

/**
 * @author john huang
 * 2015年9月18日 下午3:43:34
 * 本类主要做为 客户开发管理service
 */
@Service("CustomerDevService")
public class CustomerDevServiceImpl implements CustomerDevService {

	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	@Autowired
	CandidateDevelopMapper cdDao;
	@Autowired
	CandidateMapper canDao;
	@Autowired
	AssistantDevelopCountMapper adcDao;
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.CustomerDevService#assignCancidate2assistant()
	 */
	@Autowired AppointmentMapper appointmentDao;
	@Autowired CandidateMapper candidateDao;
	@Override
	@Transactional(propagation=Propagation.REQUIRED,rollbackFor=Exception.class,value="txManager")
	public Integer addAppointment(CandidateAddBodyVO body) throws BusinessException{
		
		Appointment appointment=new Appointment();
		appointment.setBabyName(body.getBabyName());
		appointment.setBabySex(body.getBabySex());
		appointment.setInsertTime(new Date());
		appointment.setCity(body.getCity());
		appointment.setDistrict(body.getDistrict());
		appointment.setMobileNum(body.getMobileNum());
		appointment.setParentName(body.getUserName());
		appointment.setUnionId(body.getUnionId());
		if(StringUtils.isNotBlank(body.getBabyBirthday())){
			try {
				appointment.setBabyBirthday(DateUtil.parse(body.getBabyBirthday()).getTime());
				
			} catch (ParseException e) {
				throw new BusinessException(BusinessException.ERRCODE_REQUEST,"时间格式不正确");
			}
			
		}
		appointmentDao.insert(appointment);
		Appointment appointment2=appointmentDao.selectByUnionId(body.getUnionId()).get(0);
		return appointment2.getId();
	}
	@Override
	public Candidate queryCandidate(String mobileNum) {
		Candidate ca=candidateDao.selectByMobileNum(mobileNum);
		
		return ca;
	}
	@Override
	@Transactional(propagation=Propagation.REQUIRED,rollbackFor=Exception.class,value="txManager")
	public void addCandidate(CandidateAddBodyVO body) throws BusinessException {
		Candidate ca=new Candidate();
		ca.setBabySex(body.getBabySex());
		ca.setCity(body.getCity());
		ca.setDistrict(body.getDistrict());
		ca.setMobileNum(body.getMobileNum());
		ca.setParentName(body.getUserName());
		if(StringUtils.isNotBlank(body.getBabyBirthday())){
			try {
				ca.setBabyBirthday(DateUtil.parse(body.getBabyBirthday()).getTime());
				
			} catch (ParseException e) {
				throw new BusinessException(BusinessException.ERRCODE_REQUEST,"时间格式不正确");
			}
			
		}
		candidateDao.insert(ca);
	}
	@Override
	public List<Appointment> queryAppointments(String unionId)
			throws BusinessException {
		List<Appointment> appdintments=appointmentDao.selectNotUseByUnionId(unionId);
		return appdintments;
	}
	@Override
	public void assignCancidate2assistant() {
		if (log.isDebugEnabled()) {
			log.debug(String.format("指定空的任务到业务员开始"));
		}
		List<Candidate>  candidates =   canDao.selectNoAssistantCandidate();
		for (Iterator iterator = candidates.iterator(); iterator.hasNext();) {
			Candidate candidate = (Candidate) iterator.next();
			assignAassistant(candidate);
		}
		
		if (log.isDebugEnabled()) {
			log.debug(String.format("指定空的任务到业务员结束"));
		}
	}
	
	/**
	 * 为客户指定业务员 
	 * @param candidate
	 * @return 
	 */
	private boolean assignAassistant(Candidate candidate) {
		if (log.isDebugEnabled()) {
			log.debug(String.format("为待开发客户%s分配业务员开始",candidate));
		}
		boolean assigned=false;
		// 指定符合的业务员
		List<Assistant> assistants =  cdDao.selectIdleAssistant(candidate);
		for (Iterator iterator = assistants.iterator(); iterator.hasNext();) {
			Assistant assistant = (Assistant) iterator.next();
			CandidateDevelop record=new CandidateDevelop();
			record.setAssistantId(assistant.getId());
			record.setCandidateId(candidate.getId());
			record.setInsertTime(new Date());
			cdDao.insert(record);
			candidate.setCurrentAssistantId(assistant.getId());
			canDao.updateByPrimaryKey(candidate);
			assigned=true;
			break;
		}
		if (log.isDebugEnabled()) {
			log.debug(String.format("为待开发客户分配业务员完成,分配%s到业务员",(assigned?"":"不")));
		}
		return assigned;
	}

	/**
	 * 设置候选人等级
	 */
	@Override
	public void autoSetCandidateLevel(){
		if (log.isDebugEnabled()) {
			log.debug(String.format("设置候选人等级开始"));
		}
		cdDao.change2z();
		if (log.isDebugEnabled()) {
			log.debug(String.format("设置候选人等级完成"));
		}
	}
	
	/**
	 * 设置新业务员的业务发展数
	 */
	@Override
	public void autosetNewAssistantDevelopCount(){
		if (log.isDebugEnabled()) {
			log.debug(String.format("设置新业务员的业务发展数"));
		}
		adcDao.insertNewAssistant();
	}
	

}
