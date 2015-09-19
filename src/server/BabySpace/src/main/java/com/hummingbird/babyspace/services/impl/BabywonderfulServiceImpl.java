/**
 * 
 * BabywonderfulServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Advertisement;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.mapper.BabyWonderfulMapper;
import com.hummingbird.babyspace.services.BabywonderfulService;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午9:47:49
 * 本类主要做为 宝贝精彩
 */
@Service
public class BabywonderfulServiceImpl implements BabywonderfulService {

	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	@Autowired
	BabyWonderfulMapper dao;
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.BabywonderfulService#getBabywonderfulByPage(java.lang.String, com.hummingbird.common.face.Pagingnation)
	 */
	@Override
	public List<BabyWonderful> getBabywonderfulByPage(String unionId, Pagingnation page) {
		if(page!=null&&page.isCountsize()){
			int totalcount = dao.selectTotalCountByUnionId(unionId);
			page.setTotalCount(totalcount);
			page.calculatePageCount();
		}
		List<BabyWonderful> advertisements = dao.selectByUnionId(unionId,page);
		return advertisements;
	}

}
