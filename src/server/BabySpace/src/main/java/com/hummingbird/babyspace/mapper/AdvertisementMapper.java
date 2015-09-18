package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.Advertisement;

public interface AdvertisementMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Advertisement record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Advertisement record);

    /**
     * 根据主键查询记录
     */
    Advertisement selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Advertisement record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKeyWithBLOBs(Advertisement record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Advertisement record);
}