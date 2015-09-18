package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.WechatSetting;

public interface WechatSettingMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(String appid);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(WechatSetting record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(WechatSetting record);

    /**
     * 根据主键查询记录
     */
    WechatSetting selectByPrimaryKey(String appid);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(WechatSetting record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(WechatSetting record);
}