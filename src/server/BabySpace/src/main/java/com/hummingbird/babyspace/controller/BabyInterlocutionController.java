package com.hummingbird.babyspace.controller;

import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.function.Function;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.commons.beanutils.BeanUtils;
import org.apache.commons.lang.ObjectUtils;
import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.Advertisement;
import com.hummingbird.babyspace.entity.AppLog;
import com.hummingbird.babyspace.entity.Assistant;
import com.hummingbird.babyspace.entity.Interlocution;
import com.hummingbird.babyspace.mapper.AppLogMapper;
import com.hummingbird.babyspace.mapper.AssistantMapper;
import com.hummingbird.babyspace.services.AppInfoService;
import com.hummingbird.babyspace.services.BabyInterlocutionService;
import com.hummingbird.babyspace.vo.BabyInterlocutionSubmitQuestion;
import com.hummingbird.babyspace.vo.UnionIdQueryPagingVO;
import com.hummingbird.common.controller.BaseController;
import com.hummingbird.common.event.EventListenerContainer;
import com.hummingbird.common.event.RequestEvent;
import com.hummingbird.common.exception.DataInvalidException;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.ext.AccessRequered;
import com.hummingbird.common.util.CollectionTools;
import com.hummingbird.common.util.DateUtil;
import com.hummingbird.common.util.JsonUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.vo.ResultModel;
import com.hummingbird.commonbiz.service.IAuthenticationService;
import com.hummingbird.commonbiz.vo.BaseTransVO;

/**
 * @author Lion 2015年2月11日 下午2:51:12 本类主要做为 宝宝问答
 */
@Controller
@RequestMapping(value="/knowledgeManager/babyInterlocution",method=RequestMethod.POST)
public class BabyInterlocutionController extends BaseController {

	
	@Autowired(required = true)
	protected AppInfoService appService;
	@Autowired(required = true)
	protected IAuthenticationService authSrv;
	@Autowired(required = true)
	protected BabyInterlocutionService interlocutionSrv;
	
	@Autowired(required = true)
	protected AssistantMapper assDao;
	@Autowired(required = true)
	protected AppLogMapper applogDao;
	
	
	/**
	 * 查询宝宝问答列表
	 * @return
	 */
	@RequestMapping(value="/questionList",method=RequestMethod.POST)
	@AccessRequered(methodName = "查询宝宝问答列表")
	// 框架的日志处理
	public @ResponseBody ResultModel questionList(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查询宝宝问答列表";
		int basecode = 260100;
		BaseTransVO<UnionIdQueryPagingVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,UnionIdQueryPagingVO.class);
		} catch (Exception e) {
			log.error(String.format("获取%s参数出错",messagebase),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, messagebase+"参数"));
			return rm;
		}
//		// 预设的一些信息
		
		rm.setBaseErrorCode(basecode);
		rm.setErrmsg(messagebase + "成功");
		RequestEvent qe=null ;
		
		
		AppLog rnr = new AppLog();
		rnr.setAppid(transorder.getApp().getAppId());
		rnr.setRequest(ObjectUtils.toString(request.getAttribute("rawjson")));
		rnr.setInserttime(new Date());
		rnr.setMethod("/knowledgeManager/babyInterlocution/questionList");
		Map<Integer,Assistant> teachermap = new HashMap<Integer,Assistant>();
		try {
			com.hummingbird.common.face.Pagingnation page = transorder.getBody().toPagingnation();
			List<Interlocution> objectlist = interlocutionSrv.getBabyInterlocutionByPage(transorder.getBody().getUnionId(),page);
			List<Map> advs = CollectionTools.convertCollection(objectlist, Map.class, new CollectionTools.CollectionElementConvertor<Interlocution, Map>() {

				@Override
				public Map convert(Interlocution ori) {
					
					Map row=new HashMap();
					row.put("questionTime", DateUtil.formatCommonDateorNull(ori.getInsertTime()));
					row.put("title", (ori.getTitle()));
					row.put("desc", (ori.getQuestion()));
					row.put("answer", (ori.getAnswer()));
					//加载业务员信息
					if(ori.getReplyOperator()!=null){
						Assistant ass = teachermap.computeIfAbsent(ori.getReplyOperator(), new Function<Integer, Assistant>() {

							@Override
							public Assistant apply(Integer replyerId) {
								
								return assDao.selectByPrimaryKey(replyerId);
							}
							
							
						});
						if(ass!=null){
							row.put("answerUser", ass.getUsername());
							
						}
						
					}
					return row;
					
				}
			});
			mergeListOutput(rm, page, advs);
			
		}catch (Exception e1) {
			log.error(String.format(messagebase + "失败"), e1);
			rm.mergeException(e1);
			if(qe!=null)
				qe.setSuccessed(false);
		} finally {
			
			try {
				rnr.setRespone(StringUtils.substring(JsonUtil.convert2Json(rm),0,2000));
				applogDao.insert(rnr);
			} catch (DataInvalidException e) {
				log.error(String.format("日志处理出错"),e);
			}
			
			if(qe!=null)
				EventListenerContainer.getInstance().fireEvent(qe);
		}
		return rm;
		
	}


	/**
	 * 提出宝宝问题
	 * @return
	 */
	@RequestMapping(value="/submitQuestion",method=RequestMethod.POST)
	@AccessRequered(methodName = "提出宝宝问题")
	// 框架的日志处理
	public @ResponseBody ResultModel submitQuestion(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "提出宝宝问题";
		int basecode = 260200;
		BaseTransVO<BabyInterlocutionSubmitQuestion> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,BabyInterlocutionSubmitQuestion.class);
		} catch (Exception e) {
			log.error(String.format("获取%s参数出错",messagebase),e);
			rm.mergeException(ValidateException.ERROR_PARAM_FORMAT_ERROR.cloneAndAppend(null, messagebase+"参数"));
			return rm;
		}
//		// 预设的一些信息
		
		rm.setBaseErrorCode(basecode);
		rm.setErrmsg(messagebase + "成功");
		RequestEvent qe=null ;
		
		
		AppLog rnr = new AppLog();
		rnr.setAppid(transorder.getApp().getAppId());
		rnr.setRequest(ObjectUtils.toString(request.getAttribute("rawjson")));
		rnr.setInserttime(new Date());
		rnr.setMethod("/knowledgeManager/babyInterlocution/submitQuestion");
		
		try {
			
			Interlocution question = new Interlocution();
			question.setInsertTime(new Date());
			question.setUnionId(transorder.getBody().getUnionId());
			question.setQuestion(transorder.getBody().getDesc());
			question.setTitle(transorder.getBody().getTitle());
			interlocutionSrv.addInterlocution(question);
		}catch (Exception e1) {
			log.error(String.format(messagebase + "失败"), e1);
			rm.mergeException(e1);
			if(qe!=null)
				qe.setSuccessed(false);
		} finally {
			try {
				rnr.setRespone(StringUtils.substring(JsonUtil.convert2Json(rm),0,2000));
				applogDao.insert(rnr);
			} catch (DataInvalidException e) {
				log.error(String.format("日志处理出错"),e);
			}
			
			if(qe!=null)
				EventListenerContainer.getInstance().fireEvent(qe);
		}
		return rm;
		
	}
	
}
