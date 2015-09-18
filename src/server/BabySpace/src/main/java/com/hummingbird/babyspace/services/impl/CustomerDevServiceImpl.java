/**
 * 
 * CustomerDevServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.Date;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Assistant;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.entity.CandidateDevelop;
import com.hummingbird.babyspace.mapper.AssistantDevelopCountMapper;
import com.hummingbird.babyspace.mapper.CandidateDevelopMapper;
import com.hummingbird.babyspace.mapper.CandidateMapper;
import com.hummingbird.babyspace.services.CustomerDevService;

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
	public void autoSetCandidateLevel(){
		
	}
	
	/**
	 * 设置新业务员的业务发展数
	 */
	public void autosetNewAssistantDevelopCount(){
		if (log.isDebugEnabled()) {
			log.debug(String.format("设置新业务员的业务发展数"));
		}
		adcDao.insertNewAssistant();
	}
	

}
