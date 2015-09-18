package com.hummingbird.babyspace.mapper;

import com.hummingbird.babyspace.entity.Encyclopedia;

public interface EncyclopediaMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Encyclopedia record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Encyclopedia record);

    /**
     * 根据主键查询记录
     */
    Encyclopedia selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Encyclopedia record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKeyWithBLOBs(Encyclopedia record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Encyclopedia record);
}