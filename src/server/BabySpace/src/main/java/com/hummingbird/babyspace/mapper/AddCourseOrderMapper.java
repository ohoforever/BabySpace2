package com.hummingbird.babyspace.mapper;

import java.util.List;

import com.hummingbird.babyspace.entity.AddCourseOrder;

public interface AddCourseOrderMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(String orderId);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(AddCourseOrder record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(AddCourseOrder record);

    /**
     * 根据主键查询记录
     */
    AddCourseOrder selectByPrimaryKey(String orderId);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(AddCourseOrder record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(AddCourseOrder record);
    
    /**
     * 根据宝宝查课程
     * @param childId
     * @return
     */
    List<AddCourseOrder> selectByChildId(Integer childId);
}