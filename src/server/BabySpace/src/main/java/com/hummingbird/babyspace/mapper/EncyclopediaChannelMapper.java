package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.EncyclopediaChannel;

public interface EncyclopediaChannelMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(EncyclopediaChannel record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(EncyclopediaChannel record);

    /**
     * 根据主键查询记录
     */
    EncyclopediaChannel selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(EncyclopediaChannel record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(EncyclopediaChannel record);
}