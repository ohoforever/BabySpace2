/**
 * 
 * AdvertisementService.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services;

import java.util.List;

import com.hummingbird.babyspace.entity.Advertisement;
import com.hummingbird.babyspace.entity.BabyMature;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午12:23:21
 * 本类主要做为 成长时光service
 */
public interface BabyMatureService {

	/**
	 * 查询成长时光列表
	 * @param unionId
	 * @param page
	 * @return
	 */
	public List<BabyMature> getBabyMatureByPage(String unionId,Pagingnation page);
	
}
