package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.Member;

public interface MemberMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Member record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Member record);

    /**
     * 根据主键查询记录
     */
    Member selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Member record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Member record);
    
    /**
     * 根据userId查询会员
     */
    Member selectByUserId(Integer userId);

}