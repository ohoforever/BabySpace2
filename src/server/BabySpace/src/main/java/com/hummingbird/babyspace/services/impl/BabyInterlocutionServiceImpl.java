/**
 * 
 * AdvertisementServiceImpl.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.services.impl;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.hummingbird.babyspace.entity.Interlocution;
import com.hummingbird.babyspace.exception.BabyInterlocutionException;
import com.hummingbird.babyspace.mapper.InterlocutionMapper;
import com.hummingbird.babyspace.services.BabyInterlocutionService;
import com.hummingbird.common.face.Pagingnation;

/**
 * @author john huang
 * 2015年9月19日 上午7:02:04
 * 本类主要做为 广告管理
 */
@Service
public class BabyInterlocutionServiceImpl implements BabyInterlocutionService {

	@Autowired(required = true)
	protected InterlocutionMapper interlocutionDao;
	
	org.apache.commons.logging.Log log = org.apache.commons.logging.LogFactory.getLog(this.getClass());
	
	/* (non-Javadoc)
	 * @see com.hummingbird.babyspace.services.AdvertisementService#getAdvertisementByPage(java.lang.String, com.hummingbird.babyspace.face.Pagingnation)
	 */
	@Override
	public List<Interlocution> getBabyInterlocutionByPage(String unionId, Pagingnation page) {
		if(page!=null&&page.isCountsize()){
			int totalcount = interlocutionDao.selectTotalCountByUnionId(unionId);
			page.setTotalCount(totalcount);
			page.calculatePageCount();
		}
		List<Interlocution> list = interlocutionDao.selectByUnionId(unionId,page);
		return list;
	}
	
	/**
	 * 提出问题
	 * @param question
	 * @throws BabyInterlocutionException 
	 */
	public void addInterlocution(Interlocution question) throws BabyInterlocutionException{
		if(1!=interlocutionDao.insert(question)){
			if (log.isDebugEnabled()) {
				log.debug(String.format("插入问题到数据库,返回更新记录数不对"));
			}
			throw new BabyInterlocutionException(BabyInterlocutionException.ERR_ORDER,"提出问题失败");
		}
	}

}
