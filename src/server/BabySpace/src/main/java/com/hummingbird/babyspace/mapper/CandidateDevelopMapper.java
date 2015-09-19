package com.hummingbird.babyspace.mapper;

import java.util.List;

import com.hummingbird.babyspace.entity.Assistant;
import com.hummingbird.babyspace.entity.Candidate;
import com.hummingbird.babyspace.entity.CandidateDevelop;

public interface CandidateDevelopMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(CandidateDevelop record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(CandidateDevelop record);

    /**
     * 根据主键查询记录
     */
    CandidateDevelop selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(CandidateDevelop record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(CandidateDevelop record);

	/**
	 * 为待开发的客户查询合适的业务员
	 * @param candidate
	 * @return
	 */
	List<Assistant> selectIdleAssistant(Candidate candidate);
}