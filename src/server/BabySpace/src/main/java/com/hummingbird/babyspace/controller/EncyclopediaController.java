package com.hummingbird.babyspace.controller;

import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.commons.lang.ObjectUtils;
import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.AppLog;
import com.hummingbird.babyspace.entity.Assistant;
import com.hummingbird.babyspace.entity.Encyclopedia;
import com.hummingbird.babyspace.mapper.AppLogMapper;
import com.hummingbird.babyspace.mapper.EncyclopediaMapper;
import com.hummingbird.babyspace.services.AppInfoService;
import com.hummingbird.babyspace.services.EncyclopediaService;
import com.hummingbird.babyspace.vo.EncyclopediaQueryPagingVO;
import com.hummingbird.babyspace.vo.RecordIdGetDetailVO;
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
 * @author Lion 2015年2月11日 下午2:51:12 本类主要做为 十万个为什么
 */
@Controller
@RequestMapping(value="/knowledgeManager/encyclopedia",method=RequestMethod.POST)
public class EncyclopediaController extends BaseController {

	
	@Autowired(required = true)
	protected AppInfoService appService;
	@Autowired(required = true)
	protected IAuthenticationService authSrv;
	@Autowired(required = true)
	protected EncyclopediaService encyclopediaSrv;
	
	@Autowired(required = true)
	protected EncyclopediaMapper encyclopediaDao;
	@Autowired(required = true)
	protected AppLogMapper applogDao;
	
	
	/**
	 * 查询十万个为什么列表
	 * @return
	 */
	@RequestMapping(value="/queryEncyclopediaList",method=RequestMethod.POST)
	@AccessRequered(methodName = "查询十万个为什么列表")
	// 框架的日志处理
	public @ResponseBody ResultModel queryEncyclopediaList(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查询十万个为什么列表";
		int basecode = 280100;
		BaseTransVO<EncyclopediaQueryPagingVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,EncyclopediaQueryPagingVO.class);
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
		rnr.setMethod("/knowledgeManager/encyclopedia/queryEncyclopediaList");
		try {
			com.hummingbird.common.face.Pagingnation page = transorder.getBody().toPagingnation();
			List<Encyclopedia> objectlist = encyclopediaSrv.getEncyclopediaByPage(transorder.getBody().getUnionId(), transorder.getBody().getChannelId(), transorder.getBody().getSearchKeyword(), page);
			List<Map> advs = CollectionTools.convertCollection(objectlist, Map.class, new CollectionTools.CollectionElementConvertor<Encyclopedia, Map>() {

				@Override
				public Map convert(Encyclopedia ori) {
					Map row=new HashMap();
					row.put("updateTime", DateUtil.formatCommonDateorNull(ori.getInsertTime()));
					row.put("title", (ori.getTitle()));
					row.put("describe", (ori.getDescription()));
					row.put("id", (ori.getId()));
					//加载业务员信息
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
	 * 查看十万个为什么详情
	 * @return
	 */
	@RequestMapping(value="/queryEncyclopediaDetail",method=RequestMethod.POST)
	@AccessRequered(methodName = "查看十万个为什么详情")
	// 框架的日志处理
	public @ResponseBody ResultModel queryEncyclopediaDetail(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查看十万个为什么详情";
		int basecode = 280200;
		BaseTransVO<RecordIdGetDetailVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,RecordIdGetDetailVO.class);
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
		rnr.setMethod("/knowledgeManager/encyclopedia/queryEncyclopediaDetail");
		
		try {
			
			Encyclopedia ori = encyclopediaDao.selectByPrimaryKey(transorder.getBody().getRecordId());
			Map row= new HashMap();
			row.put("updateTime", DateUtil.formatCommonDateorNull(ori.getInsertTime()));
			row.put("title", (ori.getTitle()));
			row.put("describe", (ori.getDescription()));
			row.put("id", (ori.getId()));
			row.put("content", (ori.getContent()));
			row.put("tag", (ori.getTag()));
			rm.put("result", row);
			
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
