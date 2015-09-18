package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.WechatUserShae;

public interface WechatUserShaeMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(WechatUserShae record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(WechatUserShae record);

    /**
     * 根据主键查询记录
     */
    WechatUserShae selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(WechatUserShae record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(WechatUserShae record);
}