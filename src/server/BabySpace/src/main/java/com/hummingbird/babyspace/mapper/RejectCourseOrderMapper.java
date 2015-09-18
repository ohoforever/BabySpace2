package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.RejectCourseOrder;

public interface RejectCourseOrderMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(String orderId);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(RejectCourseOrder record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(RejectCourseOrder record);

    /**
     * 根据主键查询记录
     */
    RejectCourseOrder selectByPrimaryKey(String orderId);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(RejectCourseOrder record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(RejectCourseOrder record);
}