package com.hummingbird.babyspace.controller;

import java.lang.reflect.InvocationTargetException;
import java.util.Date;
import java.util.List;
import java.util.Map;

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
import com.hummingbird.babyspace.mapper.AdvertisementMapper;
import com.hummingbird.babyspace.mapper.AppLogMapper;
import com.hummingbird.babyspace.services.AdvertisementService;
import com.hummingbird.babyspace.services.AppInfoService;
import com.hummingbird.babyspace.vo.AdvertisementGetDetailVO;
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
 * @author Lion 2015年2月11日 下午2:51:12 本类主要做为 广告展示
 */
@Controller
@RequestMapping(value="/advertisement",method=RequestMethod.POST)
public class AdvertisementController extends BaseController {

	
	@Autowired(required = true)
	protected AppInfoService appService;
	@Autowired(required = true)
	protected IAuthenticationService authSrv;
	@Autowired(required = true)
	protected AdvertisementService advertisementSrv;
	
	@Autowired(required = true)
	protected AdvertisementMapper advertisementDao;
	@Autowired(required = true)
	protected AppLogMapper applogDao;
	
	
	/**
	 * 查询广告列表
	 * @return
	 */
	@RequestMapping(value="/getAdvertisementList",method=RequestMethod.POST)
	@AccessRequered(methodName = "查询广告列表")
	// 框架的日志处理
	public @ResponseBody ResultModel getAdvertisementList(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查询广告列表";
		int basecode = 220001;
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
		rnr.setMethod("/advertisement/getAdvertisementList");
		
		try {
			com.hummingbird.common.face.Pagingnation page = transorder.getBody().toPagingnation();
			List<Advertisement> advertisements = advertisementSrv.getAdvertisementByPage(transorder.getBody().getUnionId(),page);
			List<Map> advs = CollectionTools.convertCollection(advertisements, Map.class, new CollectionTools.CollectionElementConvertor<Advertisement, Map>() {

				@Override
				public Map convert(Advertisement ori) {
					
					try {
						Map row= BeanUtils.describe(ori);
						row.put("insertTime", DateUtil.formatCommonDateorNull(ori.getInsertTime()));
						row.put("updateTime", DateUtil.formatCommonDateorNull(ori.getUpdateTime()));
						row.remove("class");
						return row;
						
					} catch (IllegalAccessException | InvocationTargetException | NoSuchMethodException e) {
						log.error(String.format("转换广告对象为map对象出错"),e);
						return null;
					}
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
	 * 查询广告列表
	 * @return
	 */
	@RequestMapping(value="/getAdvertisementDetail",method=RequestMethod.POST)
	@AccessRequered(methodName = "查看广告详情")
	// 框架的日志处理
	public @ResponseBody ResultModel getAdvertisementDetail(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查看广告详情";
		int basecode = 220002;
		BaseTransVO<AdvertisementGetDetailVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,AdvertisementGetDetailVO.class);
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
		rnr.setMethod("/advertisement/getAdvertisementDetail");
		
		try {
			Advertisement advertisement = advertisementDao.selectByPrimaryKey(transorder.getBody().getAdvertisementId());
			Map row= BeanUtils.describe(advertisement);
			row.put("insertTime", DateUtil.formatCommonDateorNull(advertisement.getInsertTime()));
			row.put("updateTime", DateUtil.formatCommonDateorNull(advertisement.getUpdateTime()));
			row.remove("class");
				
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
