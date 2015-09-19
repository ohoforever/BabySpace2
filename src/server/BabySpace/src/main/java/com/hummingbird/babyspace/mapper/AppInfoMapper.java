package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.AppInfo;

public interface AppInfoMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(String appId);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AppInfo record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AppInfo record);

    /**
     * 根据主键查询记录
     */
    AppInfo selectByPrimaryKey(String appId);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AppInfo record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AppInfo record);
}