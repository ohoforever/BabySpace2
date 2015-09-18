package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.UserCourses;

public interface UserCoursesMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer userId);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(UserCourses record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(UserCourses record);

    /**
     * 根据主键查询记录
     */
    UserCourses selectByPrimaryKey(Integer userId);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(UserCourses record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(UserCourses record);
}