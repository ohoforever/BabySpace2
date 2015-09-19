package com.hummingbird.babyspace.mapper;

import java.util.List;

import com.hummingbird.babyspace.entity.Child;

public interface ChildMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Child record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Child record);

    /**
     * 根据主键查询记录
     */
    Child selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Child record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Child record);
    
    public List<Child> selectByUserId(Integer userId);
    
    int selectUserIdByChildId(Integer childId);
}