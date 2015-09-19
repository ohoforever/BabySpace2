package com.hummingbird.babyspace.mapper;

import java.util.List;

import org.apache.ibatis.annotations.Param;

import com.hummingbird.babyspace.entity.Interlocution;
import com.hummingbird.common.face.Pagingnation;

public interface InterlocutionMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(Interlocution record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(Interlocution record);

    /**
     * 根据主键查询记录
     */
    Interlocution selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(Interlocution record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(Interlocution record);

	/**
	 * 查询记录数
	 * @param unionId
	 * @return
	 */
	int selectTotalCountByUnionId(String unionId);

	/**
	 * 查询分页
	 * @param unionId
	 * @param page
	 * @return
	 */
	List<Interlocution> selectByUnionId(@Param("unionId") String unionId,@Param("page")  Pagingnation page);
}