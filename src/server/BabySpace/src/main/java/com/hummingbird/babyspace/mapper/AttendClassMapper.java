package com.hummingbird.babyspace.mapper;

import java.util.List;

import org.apache.ibatis.annotations.Param;

import com.hummingbird.babyspace.entity.AttendClass;
import com.hummingbird.babyspace.face.Pagingnation;

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
    
    /**
     * 查询耗课节数
     */
    int queryCourseCount(String orderId);

    int queryAddCourseOrderTotal(String orderId);
    
    List<AttendClass> queryAddCourseOrder(@Param("orderId")String orderId,@Param("page")Pagingnation page);
}