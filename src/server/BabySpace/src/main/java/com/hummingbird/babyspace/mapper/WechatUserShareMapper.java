package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.WechatUserShare;

public interface WechatUserShareMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(WechatUserShare record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(WechatUserShare record);

    /**
     * 根据主键查询记录
     */
    WechatUserShare selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(WechatUserShare record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(WechatUserShare record);
}