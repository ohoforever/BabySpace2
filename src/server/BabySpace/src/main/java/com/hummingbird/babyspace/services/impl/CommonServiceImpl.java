package com.hummingbird.babyspace.services.impl;

import java.util.Date;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;






import com.hummingbird.babyspace.entity.Like;
import com.hummingbird.babyspace.entity.Share;
import com.hummingbird.babyspace.mapper.LikeMapper;
import com.hummingbird.babyspace.mapper.ShareMapper;
import com.hummingbird.babyspace.services.CommonService;
@Service
public class CommonServiceImpl implements CommonService{
	@Autowired
	ShareMapper shareDao;
	@Autowired
	LikeMapper likeDao;
	
	@Override
	public void share(String unionId, String type, Integer recordId) {
		Share share=new Share();
		share.setInsertTime(new Date());
		share.setRecordId(recordId);
		share.setType(type);
		share.setUnionId(unionId);
		shareDao.insert(share);
		
	}

	@Override
	public void praise(String unionId, String type, Integer recordId) {
		Like like=new Like();
		like.setInsertTime(new Date());
		like.setRecordId(recordId);
		like.setType(type);
		like.setUnionId(unionId);
		likeDao.insert(like);
	}

}
