package com.hummingbird.babyspace.mapper;

import java.util.List;

import com.hummingbird.babyspace.entity.Appointment;

public interface AppointmentMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Appointment record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Appointment record);

    /**
     * 根据主键查询记录
     */
    Appointment selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Appointment record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Appointment record);
    /**
    *
    * @param unionId
    * @return
    */
   List<Appointment> selectByUnionId(String unionId);
   /**
    * 查询没有被使用过的预约
    * @param unionId
    * @return
    */
   List<Appointment> selectNotUseByUnionId(String unionId);
}