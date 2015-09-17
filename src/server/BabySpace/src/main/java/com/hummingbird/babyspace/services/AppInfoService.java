/**
 * 
 * appInfoService.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services;

import com.hummingbird.common.exception.DataInvalidException;
import com.hummingbird.common.vo.ValidateResult;
import com.hummingbird.commonbiz.vo.AppVO;
import com.hummingbird.babyspace.entity.AppInfo;

/**
 * @author huangjiej_2
 * 2015年1月3日 下午1:10:57
 * 本类主要做为
 */
public interface AppInfoService {

	public abstract ValidateResult validate(AppVO appvo) throws DataInvalidException;

	public abstract AppInfo getAppByAppid(String appId);

	/**
	 * @param appId
	 * @return
	 */
	public abstract String getPublicKeyStr(String appId);

}
