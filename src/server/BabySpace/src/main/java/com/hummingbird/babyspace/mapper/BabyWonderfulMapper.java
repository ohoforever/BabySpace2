package com.hummingbird.babyspace.mapper;

import java.util.List;

import org.apache.ibatis.annotations.Param;

import com.hummingbird.babyspace.entity.Advertisement;
import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.common.face.Pagingnation;

public interface BabyWonderfulMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(BabyWonderful record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(BabyWonderful record);

    /**
     * 根据主键查询记录
     */
    BabyWonderful selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(BabyWonderful record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(BabyWonderful record);

	/**
	 * 获取总记录数
	 * @param unionId
	 * @return
	 */
	int selectTotalCountByUnionId(String unionId);

	/**
	 * 获取分页列表
	 * @param unionId
	 * @param page
	 * @return
	 */
	List<BabyWonderful> selectByUnionId(@Param("unionId") String unionId,@Param("page") Pagingnation page);
}