package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.AttendClass;

public interface AttendClassMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AttendClass record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AttendClass record);

    /**
     * 根据主键查询记录
     */
    AttendClass selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AttendClass record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AttendClass record);
}