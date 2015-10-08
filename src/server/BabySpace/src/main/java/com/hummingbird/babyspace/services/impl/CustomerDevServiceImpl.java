/**
 * 
 * CustomerDevServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.text.ParseException;
import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;
import java.util.Random;
import java.util.function.Function;

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
import com.hummingbird.babyspace.mapper.AssistantMapper;
import com.hummingbird.babyspace.mapper.CandidateDevelopMapper;
import com.hummingbird.babyspace.mapper.CandidateMapper;
import com.hummingbird.babyspace.services.CustomerDevService;
import com.hummingbird.babyspace.vo.CandidateAddBodyVO;
import com.hummingbird.common.exception.BusinessException;
import com.hummingbird.common.exception.DataInvalidException;
import com.hummingbird.common.exception.RequestException;
import com.hummingbird.common.util.DateUtil;
import com.hummingbird.common.util.JsonUtil;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.StrUtil;
import com.hummingbird.common.util.http.HttpRequester;
import com.hummingbird.common.vo.ResultModel;
import com.hummingbird.commonbiz.vo.AppVO;

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
	AssistantMapper assDao;
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
	public List<Candidate> queryCandidate(String mobileNum) {
		List<Candidate> ca=candidateDao.selectByMobileNum(mobileNum);
		
		return ca;
	}
	@Override
	@Transactional(propagation=Propagation.REQUIRED,rollbackFor=Exception.class,value="txManager")
	public void addCandidate(CandidateAddBodyVO body) throws BusinessException {
		Candidate ca=new Candidate();
		ca.setBabySex(body.getBabySex());
		ca.setBabyName(body.getBabyName());
		ca.setCity(body.getCity());
		ca.setDistrict(body.getDistrict());
		ca.setMobileNum(body.getMobileNum());
		ca.setParentName(body.getUserName());
		ca.setStar(1);
		ca.setStatus("CRT");
		ca.setInsertTime(new Date());
		
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
	
	/**
	 * 定时通知业务员开发客户
	 */
	@Override
	public void notify2develop(){
		if (log.isDebugEnabled()) {
			log.debug(String.format("定时通知业务员开发客户,对于B级客户通知业务员跟进"));
		}
		Map<Integer,String> assistantmap = new HashMap<>();
		
		try {
			//加载所有的客户
			List<Candidate> cans  = canDao.getNeededNotifyCandidate();
			PropertiesUtil pu = new PropertiesUtil();
			String notifytext = pu.getProperty("candidate.develop.nofity.text");
			String notifyurl = pu.getProperty("candidate.develop.nofity.url");
			for (Iterator iterator = cans.iterator(); iterator.hasNext();) {
				Candidate candidate = (Candidate) iterator.next();
				Integer assistantId = candidate.getCurrentAssistantId();
				//获取对应的微信openid
				String openid = assistantmap.computeIfAbsent(assistantId, new Function<Integer, String>() {

					@Override
					public String apply(Integer assistantId) {
						String openId = assDao.selectOpenIdbyAssistantId(assistantId);
						
						return openId;
					}
				});
				if(StringUtils.isBlank(openid)){
					if (log.isDebugEnabled()) {
						log.debug(String.format("业务员[编号%s]找不到微信openid,不处理",assistantId));
					}
					continue;
				}
				//{"body":{"touser":"oITR0uAkXSsTgY2YaU2ItDN2kh7g","msgtype":"text","text":{"content":"测试消息！"}},"app":{"appId":"zjhtwallet","nonce":879627,"timeStamp":1443536959,"signature":"6616a43c7a12409be47579096dfcda97"}}
				Map body = new HashMap<>();
				body.put("touser", openid);
				body.put("msgtype", "text");
				Map<String,String> textmap = new HashMap<>();
				body.put("text", textmap);
				textmap.put("content", StrUtil.replaceAllWithToken(StrUtil.replaceAllWithToken(notifytext, "babyname", candidate.getBabyName()),"mobileNum",candidate.getMobileNum()));
				Map map = new HashMap();
				AppVO app = new AppVO();
				app.setAppId("babyspace");
				app.setTimeStamp(DateUtil.formatToday("yyyyMMddHHmmss"));
				app.setNonce(String.valueOf((int)(Math.random()*10000)));
				app.setSignature(null);
				map.put("app", app);
				map.put("body", body);
				String notifyjson = JsonUtil.convert2Json(map);
				HttpRequester httpreq = new HttpRequester();// 同步URL，向该URL发起同步请求；
				String notifyresultstr = httpreq.postRequest(notifyurl, notifyjson);
				if(StringUtils.isNotBlank(notifyresultstr)){
					ResultModel rm = JsonUtil.convertJson2Obj(notifyresultstr, ResultModel.class);
					if(rm.isSuccessed()){
						if (log.isDebugEnabled()) {
							log.debug(String.format("通知成功"));
						}
					}
					else{
						if (log.isDebugEnabled()) {
							log.debug(String.format("通知失败,%s",rm.getErrmsg()));
						}
					}
				}
				else{
					if (log.isDebugEnabled()) {
						log.debug(String.format("通知服务访问失败,或不通"));
					}
				}
				
			}
		} catch (Exception e) {
			log.error(String.format("通知业务员跟进出错"),e);
		}
	}
	

}
