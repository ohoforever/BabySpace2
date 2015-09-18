package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.AttendAppointment;

public interface AttendAppointmentMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AttendAppointment record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AttendAppointment record);

    /**
     * 根据主键查询记录
     */
    AttendAppointment selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AttendAppointment record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AttendAppointment record);
}