package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.AssistantDevelopCount;

public interface AssistantDevelopCountMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AssistantDevelopCount record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AssistantDevelopCount record);
    /**
     * 对新业务员计算其业务结果数
     */
    int insertNewAssistant();

    /**
     * 根据主键查询记录
     */
    AssistantDevelopCount selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AssistantDevelopCount record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AssistantDevelopCount record);
}