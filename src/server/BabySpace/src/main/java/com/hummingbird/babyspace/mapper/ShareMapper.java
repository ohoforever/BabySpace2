package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.Share;

public interface ShareMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Share record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Share record);

    /**
     * 根据主键查询记录
     */
    Share selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Share record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Share record);
}