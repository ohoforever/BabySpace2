package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.WechatUser;

public interface WechatUserMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer userid);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(WechatUser record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(WechatUser record);

    /**
     * 根据主键查询记录
     */
    WechatUser selectByPrimaryKey(Integer userid);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(WechatUser record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKeyWithBLOBs(WechatUser record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(WechatUser record);
}