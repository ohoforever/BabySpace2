/**
 * 
 */
package com.hummingbird.babyspace.services.impl;

import java.util.HashMap;
import java.util.Map;

import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.common.exception.AuthenticationException;
import com.hummingbird.common.exception.SignatureException;
import com.hummingbird.common.exception.ValidateException;
import com.hummingbird.common.util.PropertiesUtil;
import com.hummingbird.common.util.SignatureUtil;
import com.hummingbird.commonbiz.service.IAuthenticationService;
import com.hummingbird.commonbiz.vo.AppVO;
import com.hummingbird.commonbiz.vo.BaseTransVO;
import com.hummingbird.commonbiz.vo.Decidable;
import com.hummingbird.babyspace.entity.AppInfo;
import com.hummingbird.babyspace.mapper.AppInfoMapper;

/**
 * 验证service
 * 
 * @author huangjiej_2 2014年10月16日 上午7:55:54
 */
@Service
public class AuthenticationService implements IAuthenticationService {

	protected Log log = LogFactory.getLog(getClass());

	// @Autowired(required = true)
	// private SellerMapper sellerMapper;

	@Autowired(required = true)
	private AppInfoMapper appInfoMapper;

	/*
	 * (non-Javadoc)
	 * 
	 * @see
	 * com.pay2b.service.IAuthenticationService#validateToken(com.pay2b.vo.Decidable
	 * )
	 */
	@Override
	public Object validateAuth(Decidable authObj)
			throws AuthenticationException {

		Map map = new HashMap();
		// 用户，根据appid进行查询
		if (authObj instanceof AppVO) {
			AppVO baseuserdecide = (AppVO) authObj;
			String appid= baseuserdecide.getAppId();
			AppInfo info = appInfoMapper.selectByPrimaryKey(appid);
			if (info == null) {
				log.error("根据appid:" + appid + "无法在系统中查询到相关数据");
				//throw ValidateException.ERROR_EXISTING_APP_NOT_EXISTS;
				throw new AuthenticationException(ValidateException.ERROR_EXISTING_APP_NOT_EXISTS.getErrcode(),"appId不存在");
			}
			map.put("appKey", info.getAppKey());
		}
		else if (authObj instanceof BaseTransVO) {
			BaseTransVO baseuserdecide = (BaseTransVO) authObj;
			Map appmap = (Map) validateAuth(baseuserdecide.getApp());
			map.putAll(appmap);
//			Object body = baseuserdecide.getBody();
//			if(baseuserdecide.getTsig()!=null)
//			{
//				if (body instanceof PainttextAble) {
//					PainttextAble pa = (PainttextAble) body;
//					SignatureUtil.validateSignature(baseuserdecide.getTsig().getOrderMD5(),SignatureUtil.SIGNATURE_TYPE_MD5 , pa.getPaintText());
//				}
//				else{
//					//反射获取所有
//				}
//				validateTransOrderSign(baseuserdecide);
//			}
		} else {
			log.error("认证中无法取得appid和手机号，无法进行认证");
			throw new AuthenticationException(ValidateException.ERROR_SIGNATURE_MD5.getErrcode(),"签名验证失败");
		}
		authObj.setOtherParam(map);
		boolean authed;
		try {
			authed = authObj.isAuthed();
		} catch (SignatureException e) {
			log.error("校验签名失败",e);
			throw new AuthenticationException(ValidateException.ERROR_SIGNATURE_MD5.getErrcode(),ValidateException.ERROR_SIGNATURE_MD5.getMessage(),e);
		}
		if(!authed){
			throw new AuthenticationException(ValidateException.ERROR_SIGNATURE_MD5.getErrcode(),ValidateException.ERROR_SIGNATURE_MD5.getMessage());
		}
		return map;
	}
	
	/**
	 * 验证TransOrder的签名
	 * @param transorder
	 * @throws SignatureException 
	 */
	protected void validateTransOrderSign(BaseTransVO transorder) throws SignatureException {
		if (log.isDebugEnabled()) {
			log.debug(String.format("验证TransOrder的签名"));
		}
		PropertiesUtil pu = new PropertiesUtil();
		boolean success;
//		if("true".equals(pu.getProperty("verifybypublickey")))
//		{
//			String mingwen = ValidateUtil.sortbyValues(transorder.getTsig().getTimeStamp(),transorder.getTsig().getNonce(),transorder.getTsig().getOrderMD5(),transorder.getApp().getAppId());
//			String signature = transorder.getTsig().getSignature();
//			String publickeyStr = appService.getPublicKeyStr(transorder.getApp().getAppId());
//			if(StringUtils.isBlank(publickeyStr))
//			{
//				if (log.isDebugEnabled()) {
//					log.debug(String.format("app无公钥，无法进行验签"));
//				}
//				throw ValidateException.ERROR_SIGNATURE_RSA;
//				//throw new SignatureException(ValidateException.ERRCODE_SIGNATURE_FAIL,"签名验签不通过,app无公钥");
//			}
//			try {
//				PublicKey pkey = CertificateUtils.getPublicKeyFromCer(new ByteArrayInputStream(Base64.decodeBase64(publickeyStr)));
//				
//				success = CertificateUtils.verifySignatureByPublicKey(mingwen.getBytes(), signature, pkey);
//			} catch (Exception e) {
//				if (log.isDebugEnabled()) {
//					log.error(String.format("TransOrder请求签名验签出错"),e);
//				}
//				SignatureException e1 = ValidateException.ERROR_SIGNATURE_RSA.clone(e);
//				throw e1;
////				throw new SignatureException(ValidateException.ERRCODE_SIGNATURE_FAIL,"签名验签不通过",e);
//			}
//			
//			if(!success)
//			{
//				if (log.isDebugEnabled()) {
//					log.debug(String.format("TransOrder请求签名验签不通过"));
//				}
//				SignatureException e1 = ValidateException.ERROR_SIGNATURE_RSA;
//				throw e1;
//			}
//			else{
//				if (log.isDebugEnabled()) {
//					log.debug(String.format("TransOrder请求签名验签通过"));
//				}
//				
//			}
//		}
//		else{
			
			success=SignatureUtil.validateSignature(transorder.getTsig().getSignature(), SignatureUtil.SIGNATURE_TYPE_MD5,transorder.getTsig().getTimeStamp(),transorder.getTsig().getNonce(),transorder.getTsig().getOrderMD5(),transorder.getApp().getAppId() );
			if(!success)
			{
				if (log.isDebugEnabled()) {
					log.debug(String.format("TransOrder请求签名验签不通过"));
				}
				SignatureException e1 = ValidateException.ERROR_SIGNATURE_MD5;
				throw e1;
			}
			else{
				if (log.isDebugEnabled()) {
					log.debug(String.format("TransOrder请求签名验签通过"));
				}
				
			}
//		}
	}

}
