/**
 * 
 * AdvertisementServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Advertisement;
import com.hummingbird.babyspace.mapper.AdvertisementMapper;
import com.hummingbird.babyspace.services.AdvertisementService;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午7:02:04
 * 本类主要做为 广告管理
 */
@Service
public class AdvertisementServiceImpl implements AdvertisementService {

	@Autowired(required = true)
	protected AdvertisementMapper advertisementDao;
	
	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.AdvertisementService#getAdvertisementByPage(java.lang.String, com.hummingbird.babyspace.face.Pagingnation)
	 */
	@Override
	public List<Advertisement> getAdvertisementByPage(String unionId, Pagingnation page) {
		if(page!=null&&page.isCountsize()){
			int totalcount = advertisementDao.selectTotalCountByUnionId(unionId);
			page.setTotalCount(totalcount);
			page.calculatePageCount();
		}
		List<Advertisement> advertisements = advertisementDao.selectByUnionId(unionId,page);
		return advertisements;
	}

}
