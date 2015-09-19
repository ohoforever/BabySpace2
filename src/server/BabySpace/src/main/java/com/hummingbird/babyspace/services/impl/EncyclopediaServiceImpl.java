/**
 * 
 * BabywonderfulServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.entity.Encyclopedia;
import com.hummingbird.babyspace.mapper.BabyWonderfulMapper;
import com.hummingbird.babyspace.mapper.EncyclopediaMapper;
import com.hummingbird.babyspace.services.EncyclopediaService;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午9:47:49
 * 本类主要做为 十万个为什么
 */
@Service
public class EncyclopediaServiceImpl implements EncyclopediaService {

	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	@Autowired
	EncyclopediaMapper dao;
	
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.EncyclopediaService#getEncyclopediaByPage(java.lang.String, java.lang.Integer, java.lang.String, com.hummingbird.common.face.Pagingnation)
	 */
	@Override
	public List<Encyclopedia> getEncyclopediaByPage(String unionId, Integer channelId, String searchKeyword,
			Pagingnation page) {
		if(page!=null&&page.isCountsize()){
			int totalcount = dao.selectTotalCountByUnionId(unionId,channelId,searchKeyword);
			page.setTotalCount(totalcount);
			page.calculatePageCount();
		}
		List<Encyclopedia> advertisements = dao.selectByUnionId(unionId,channelId,searchKeyword,page);
		return advertisements;
	}

}
