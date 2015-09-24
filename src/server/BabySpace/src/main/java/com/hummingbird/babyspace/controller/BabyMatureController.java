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
import com.hummingbird.babyspace.entity.BabyMature;
import com.hummingbird.babyspace.entity.BabyMatureComment;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.entity.User;
import com.hummingbird.babyspace.entity.WechatUserLike;
import com.hummingbird.babyspace.entity.WechatUserShare;
import com.hummingbird.babyspace.exception.BabyWonderfulException;
import com.hummingbird.babyspace.mapper.AppLogMapper;
import com.hummingbird.babyspace.mapper.BabyMatureCommentMapper;
import com.hummingbird.babyspace.mapper.BabyMatureMapper;
import com.hummingbird.babyspace.mapper.UserMapper;
import com.hummingbird.babyspace.mapper.WechatUserLikeMapper;
import com.hummingbird.babyspace.mapper.WechatUserShareMapper;
import com.hummingbird.babyspace.services.AppInfoService;
import com.hummingbird.babyspace.services.BabyMatureService;
import com.hummingbird.babyspace.vo.BabyMatureAddCommentVO;
import com.hummingbird.babyspace.vo.BabyMatureDetailVO;
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
 * @author Lion 2015年2月11日 下午2:51:12 本类主要做为 成长时光
 */
@Controller
@RequestMapping(value="/babyMature",method=RequestMethod.POST)
public class BabyMatureController extends BaseController {

	
	@Autowired(required = true)
	protected AppInfoService appService;
	@Autowired(required = true)
	protected IAuthenticationService authSrv;
	@Autowired(required = true)
	protected BabyMatureService babymatureSrv;
	@Autowired(required = true)
	protected BabyMatureMapper babyMatureDao;
	@Autowired(required = true)
	protected BabyMatureCommentMapper babyMatureCommentDao;
	@Autowired(required = true)
	protected AppLogMapper applogDao;
	@Autowired(required = true)
	protected UserMapper userDao;
	@Autowired(required = true)
	protected WechatUserShareMapper wechatUserShareDao;
	
	
	/**
	 * 查询成长时光列表
	 * @return
	 */
	@RequestMapping(value="/queryBabyMatureList",method=RequestMethod.POST)
	@AccessRequered(methodName = "查询成长时光列表")
	// 框架的日志处理
	public @ResponseBody ResultModel queryBabyMatureList(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查询成长时光列表";
		int basecode = 270100;
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
		rnr.setMethod("/babyMature/queryBabyMatureList");
		PropertiesUtil pu = new PropertiesUtil();
		int smallpicwidth = pu.getInt("smallpic.width",200);//缩略图
		try {
			com.hummingbird.common.face.Pagingnation page = transorder.getBody().toPagingnation();
			List<BabyMature> wonderfuls = babymatureSrv.getBabyMatureByPage(transorder.getBody().getUnionId(),page);
			List<Map> advs = CollectionTools.convertCollection(wonderfuls, Map.class, new CollectionTools.CollectionElementConvertor<BabyMature, Map>() {
				@Override
				public Map convert(BabyMature ori) {
					try {
						Map row= new HashMap();
						row.put("matrueDate", DateUtil.formatCommonDateorNull(ori.getActTime()));
						row.put("title", ori.getTitle());
						row.put("matureId", ori.getId());
						row.put("childId", ori.getChildId());
						row.put("redflower", ori.getRedflowerCount());
						row.put("determine",ori.getDetermine());
						row.put("matrueDate", DateUtil.formatCommonDateorNull(ori.getActTime()));
						//处理图片
						int i=1;
						List<String> piclist = new ArrayList<String>();
						while(i<=9){
							
							String picurl = ObjectUtils.toString(PropertyUtils.getProperty(ori, "image"+i));
							if(StringUtils.isNotBlank(picurl)){
//								piclist.add(picurl+"?imageView2/2/w/"+smallpicwidth);
								piclist.add(picurl);
							}
							i++;
						}
						row.put("images", piclist);
						row.put("shareTitle", ori.getShareTitle());
						row.put("shareContent", ori.getShareContent());
						String sharePic=null;
						if(ori.getShareImgIndex()!=null&&ori.getShareImgIndex()!=0){
							sharePic=piclist.get(ori.getShareImgIndex()>piclist.size()?1:ori.getShareImgIndex());
						}
						row.put("sharePic",sharePic );
						//加载评论
						List<BabyMatureComment> comments = babyMatureCommentDao.selectComments(ori.getId());
						if(comments!=null){
							List<Map> commentoutput = CollectionTools.convertCollection(comments, Map.class, new CollectionTools.CollectionElementConvertor<BabyMatureComment, Map>(){

								@Override
								public Map convert(BabyMatureComment ori) {
									Map com= new HashMap();
									com.put("content", ori.getContent());
									com.put("sendTime",DateUtil.formatCommonDateorNull(ori.getInsertTime()));
									com.put("senderId", ori.getSenderId());
									com.put("id", ori.getId());
									com.put("content", ori.getContent());
									com.put("senderType", ori.getSenderType());
									com.put("replyTo", ori.getReplyTo());
//									com.put("sender", ori.getSender());
									return com;
								}});
							row.put("comment", commentoutput);
						}
						return row;
						
					} catch (IllegalAccessException | InvocationTargetException | NoSuchMethodException e) {
						log.error(String.format("转换成长时光对象为map对象出错"),e);
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
	 * 查询成长时光详情
	 * @return
	 */
	@RequestMapping(value="/getBabyMature",method=RequestMethod.POST)
	@AccessRequered(methodName = "查看成长时光详情")
	// 框架的日志处理
	public @ResponseBody ResultModel getBabyMature(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "查看成长时光详情";
		int basecode = 270200;
		BaseTransVO<BabyMatureDetailVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,BabyMatureDetailVO.class);
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
		rnr.setMethod("/babyMature/getBabyMature");
		
		try {
			BabyMature ori = babyMatureDao.selectByPrimaryKey(transorder.getBody().getMatureId());
			Map row= new HashMap();
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
			row.put("images", piclist);
			row.put("shareTitle", ori.getShareTitle());
			row.put("shareContent", ori.getShareContent());
			row.put("determine", ori.getDetermine());
			String sharePic=null;
			if(ori.getShareImgIndex()!=null&&ori.getShareImgIndex()!=0){
				sharePic=piclist.get(ori.getShareImgIndex()>piclist.size()?1:ori.getShareImgIndex());
			}
			row.put("sharePic",sharePic );
			row.put("matrueId", ori.getId());
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
	
	/**
	 * 家长发表评论
	 * @return
	 */
	@RequestMapping(value="/addComment",method=RequestMethod.POST)
	@AccessRequered(methodName = "成长时光发表评论")
	// 框架的日志处理
	public @ResponseBody ResultModel addComment(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "成长时光发表评论";
		int basecode = 270400;
		BaseTransVO<BabyMatureAddCommentVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,BabyMatureAddCommentVO.class);
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
		rnr.setMethod("/babyMature/addComment");
		
		try {
			BabyMatureAddCommentVO body = transorder.getBody();
			User user = userDao.selectByUnionId(body.getUnionId());
			if(user==null){
				if (log.isDebugEnabled()) {
					log.debug(String.format("用户[微信号%s]不存在",body.getUnionId()));
				}
				throw ValidateException.ERROR_EXISTING_USER_NOT_EXISTS;
			}
			BabyMatureComment com = new BabyMatureComment();
			com.setMatureId(body.getRecordId());
			com.setReplyTo(body.getReplyTo());
			com.setSenderId(user.getId());
			com.setSenderType("USER");
			com.setContent(body.getComment());
			com.setInsertTime(new Date()); 
			babyMatureCommentDao.insert(com);
			
			
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
	 * 分享
	 * @return
	 */
	@RequestMapping(value="/addShareHistory",method=RequestMethod.POST)
	@AccessRequered(methodName = "分享")
	// 框架的日志处理
	public @ResponseBody ResultModel share(HttpServletRequest request,
			HttpServletResponse response) {
		String messagebase = "分享";
		int basecode = 270300;
		BaseTransVO<BabyMatureDetailVO> transorder = null;
		ResultModel rm = new ResultModel();
		try {
			String jsonstr = RequestUtil.getRequestPostData(request);
			request.setAttribute("rawjson", jsonstr);
			transorder = RequestUtil.convertJson2Obj(jsonstr, BaseTransVO.class,BabyMatureDetailVO.class);
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
		rnr.setMethod("/babyMature/addShareHistory");
		
		try {
			
			WechatUserShare share = new WechatUserShare();
			share.setInsertTime(new Date());
			share.setRecordId(transorder.getBody().getRecordId());//可获取到matureid
			share.setUnionId(transorder.getBody().getUnionId());
			share.setType("MATRE");
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
