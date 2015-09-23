package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.AttendClassHistory;

public interface AttendClassHistoryMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AttendClassHistory record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AttendClassHistory record);

    /**
     * 根据主键查询记录
     */
    AttendClassHistory selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AttendClassHistory record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AttendClassHistory record);
}