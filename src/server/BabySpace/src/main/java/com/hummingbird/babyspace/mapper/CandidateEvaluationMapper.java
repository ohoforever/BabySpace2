package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.CandidateEvaluation;

public interface CandidateEvaluationMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(CandidateEvaluation record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(CandidateEvaluation record);

    /**
     * 根据主键查询记录
     */
    CandidateEvaluation selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(CandidateEvaluation record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKeyWithBLOBs(CandidateEvaluation record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(CandidateEvaluation record);
}