package com.hummingbird.babyspace.controller;

import java.lang.reflect.InvocationTargetException;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import org.apache.commons.beanutils.PropertyUtils;
import org.apache.commons.lang.ObjectUtils;
import org.apache.commons.lang.StringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import com.hummingbird.babyspace.entity.AppLog;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.entity.WechatUserLike;
import com.hummingbird.babyspace.entity.WechatUserShare;
import com.hummingbird.babyspace.exception.BabyWonderfulException;
import com.hummingbird.babyspace.mapper.AppLogMapper;
import com.hummingbird.babyspace.mapper.BabyWonderfulMapper;
import com.hummingbird.babyspace.mapper.WechatUserLikeMapper;
import com.hummingbird.babyspace.mapper.WechatUserShareMapper;
import com.hummingbird.babyspace.services.AppInfoService;
import com.hummingbird.babyspace.services.BabywonderfulService;
import com.hummingbird.babyspace.vo.RecordIdGetDetailVO;
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
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.RequestUtil;
import com.hummingbird.common.vo.ResultModel;
import com.hummingbird.commonbiz.service.IAuthenticationService;
import com.hummingbird.commonbiz.vo.BaseTransVO;

/**
 * @author Lion 2015年2月11日 下午2:51:12 本类主要做为 宝贝精彩
 */
@Controller
@RequestMapping(value="/babyWonderful",method=RequestMethod.POST)
public class BabyWonderfulController extends BaseController {

	
	@Autowired(required = true)
	protected AppInfoService appService;
	@Autowired(required = true)
	protected IAuthenticationService authSrv;
	@Autowired(required = true)
	protected BabywonderfulService babywonderfulSrv;
	
	@Autowired(required = true)
	protected BabyWonderfulMapper babywonderfulDao;
	@Autowired(required = true)
	protected AppLogMapper applogDao;
	@Autowired(required = true)
	protected WechatUserLikeMapper wechatUserLikeDao;
	@Autowired(required = true)
	protected WechatUserShareMapper wechatUserShareDao;
	
	
	/**
	 * 查询宝贝精彩列表
	 * @return
	 */
	@RequestMapping(value="/babyWonderfulList",method=RequestMethod.POST)
	@AccessRequered(methodName = "查询宝贝精彩列表")
	// 框架的日志处理
	public @ResponseBody ResultModel getAdvertisementList(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查询宝贝精彩列表";
		int basecode = 240100;
		final BaseTransVO<UnionIdQueryPagingVO> transorder;
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
		rnr.setMethod("/babyWonderful/babyWonderfulList");
		PropertiesUtil pu = new PropertiesUtil();
		int smallpicwidth = pu.getInt("smallpic.width",200);//缩略图
		try {
			com.hummingbird.common.face.Pagingnation page = transorder.getBody().toPagingnation();
			List<BabyWonderful> wonderfuls = babywonderfulSrv.getBabywonderfulByPage(transorder.getBody().getUnionId(),page);
			List<Map> advs = CollectionTools.convertCollection(wonderfuls, Map.class, new CollectionTools.CollectionElementConvertor<BabyWonderful, Map>() {

				@Override
				public Map convert(BabyWonderful ori) {
					try {
						Map row= new HashMap();
						row.put("wonderfulTime", DateUtil.formatCommonDateorNull(ori.getActTime()));
						//处理图片
						int i=1;
						List<String> piclist = new ArrayList<String>();
						while(i<=9){
							
							String picurl = ObjectUtils.toString(PropertyUtils.getProperty(ori, "image"+i));
							if(StringUtils.isNotBlank(picurl)){
								piclist.add(picurl+"?imageView2/2/w/"+smallpicwidth);
							}
							i++;
						}
						row.put("pic", piclist);
						row.put("title", ori.getTitle());
						row.put("recordId", ori.getId());
						row.put("likeNum", ori.getLikeCount()==null?0:ori.getLikeCount());
						//判断用户有没有标记为喜爱
						int likecount = wechatUserLikeDao.countUserLike(transorder.getBody().getUnionId(),ori.getId(),"WDFUL");
						row.put("isUserLike", likecount!=0);
						return row;
						
					} catch (IllegalAccessException | InvocationTargetException | NoSuchMethodException e) {
						log.error(String.format("转换宝贝精彩对象为map对象出错"),e);
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
	 * 查询宝贝精彩列表
	 * @return
	 */
	@RequestMapping(value="/queryBabyWonderfulDetail",method=RequestMethod.POST)
	@AccessRequered(methodName = "查看宝贝精彩详情")
	// 框架的日志处理
	public @ResponseBody ResultModel getAdvertisementDetail(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查看宝贝精彩详情";
		int basecode = 240200;
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
		rnr.setMethod("/babyWonderful/queryBabyWonderfulDetail");
		
		try {
			BabyWonderful ori = babywonderfulDao.selectByPrimaryKey(transorder.getBody().getRecordId());
			Map row= new HashMap();
			row.put("wonderfulTime", DateUtil.formatCommonDateorNull(ori.getActTime()));
			//处理图片
			int i=1;
			List<String> piclist = new ArrayList<String>();
			while(i<=9){
				String picurl = ObjectUtils.toString(PropertyUtils.getProperty(ori, "image"+i));
				if(StringUtils.isNotBlank(picurl)){
					piclist.add(picurl);
				}
				i++;
			}
			row.put("shareTitle", ori.getShareTitle());
			row.put("shareContent", ori.getShareContent());
			row.put("sharePic", piclist.get(ori.getShareImgIndex()!=null?(ori.getShareImgIndex()>piclist.size()?0:ori.getShareImgIndex()):0));
			row.put("content", ori.getContent());
			row.put("pic", piclist);
			row.put("title", ori.getTitle());
			row.put("recordId", ori.getId());
			row.put("likeNum", ori.getLikeCount()==null?0:ori.getLikeCount());
			//判断用户有没有标记为喜爱
			int likecount = wechatUserLikeDao.countUserLike(transorder.getBody().getUnionId(),ori.getId(),"WDFUL");
			row.put("isUserLike", likecount!=0);
			rm.put("wonderfulDetail", row);
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
	 * 点赞
	 * @return
	 */
	@RequestMapping(value="/praise",method=RequestMethod.POST)
	@AccessRequered(methodName = "点赞")
	// 框架的日志处理
	public @ResponseBody ResultModel praise(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "点赞";
		int basecode = 240300;
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
		rnr.setMethod("/babyWonderful/praise");
		
		try {
			BabyWonderful ori = babywonderfulDao.selectByPrimaryKey(transorder.getBody().getRecordId());
			if(ori==null){
				throw new BabyWonderfulException(BabyWonderfulException.ERR_ORDER_NOEXIST,"宝宝精彩记录不存在");
			}
			int likecount = wechatUserLikeDao.countUserLike(transorder.getBody().getUnionId(),transorder.getBody().getRecordId(),"WDFUL");
			if(likecount==0){
				WechatUserLike like = new WechatUserLike();
				like.setInsertTime(new Date());
				like.setRecordId(transorder.getBody().getRecordId());
				like.setUnionId(transorder.getBody().getUnionId());
				like.setType("WDFUL");
				wechatUserLikeDao.insert(like);
				ori.setLikeCount(ori.getLikeCount()+1);
				babywonderfulDao.updateByPrimaryKey(ori);
			}
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
	 * 点赞
	 * @return
	 */
	@RequestMapping(value="/share",method=RequestMethod.POST)
	@AccessRequered(methodName = "分享")
	// 框架的日志处理
	public @ResponseBody ResultModel share(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "分享";
		int basecode = 240003;
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
		rnr.setMethod("/babyWonderful/share");
		
		try {
			
			WechatUserShare share = new WechatUserShare();
			share.setInsertTime(new Date());
			share.setRecordId(transorder.getBody().getRecordId());
			share.setUnionId(transorder.getBody().getUnionId());
			share.setType("WDFUL");
			wechatUserShareDao.insert(share);
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
