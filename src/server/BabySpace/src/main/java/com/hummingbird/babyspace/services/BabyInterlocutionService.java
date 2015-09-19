/**
 * 
 * AdvertisementService.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services;

import java.util.List;

import com.hummingbird.babyspace.entity.Interlocution;
import com.hummingbird.babyspace.exception.BabyInterlocutionException;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午12:23:21
 * 本类主要做为 广告管理
 */
public interface BabyInterlocutionService {

	/**
	 * 查询问答列表
	 * @param unionId
	 * @param page
	 * @return
	 */
	public List<Interlocution> getBabyInterlocutionByPage(String unionId,Pagingnation page);

	/**
	 * 提出问题
	 * @param question
	 * @throws BabyInterlocutionException 
	 */
	public void addInterlocution(Interlocution question) throws BabyInterlocutionException;
	
}
