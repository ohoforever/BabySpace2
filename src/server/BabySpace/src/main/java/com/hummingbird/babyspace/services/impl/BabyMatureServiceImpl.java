/**
 * 
 * BabywonderfulServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.BabyMature;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.mapper.BabyMatureMapper;
import com.hummingbird.babyspace.mapper.BabyWonderfulMapper;
import com.hummingbird.babyspace.services.BabyMatureService;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午9:47:49
 * 本类主要做为 成长时光
 */
@Service
public class BabyMatureServiceImpl implements BabyMatureService {

	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	@Autowired
	BabyMatureMapper dao;
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.BabywonderfulService#getBabywonderfulByPage(java.lang.String, com.hummingbird.common.face.Pagingnation)
	 */
	@Override
	public List<BabyMature> getBabyMatureByPage(String unionId, Pagingnation page) {
		if(page!=null&&page.isCountsize()){
			int totalcount = dao.selectTotalCountByUnionId(unionId);
			page.setTotalCount(totalcount);
			page.calculatePageCount();
		}
		List<BabyMature> advertisements = dao.selectByUnionId(unionId,page);
		return advertisements;
	}

}
