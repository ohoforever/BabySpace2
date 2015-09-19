package com.hummingbird.babyspace.mapper;

import java.util.List;

import org.apache.ibatis.annotations.Param;

import com.hummingbird.babyspace.entity.BabyWonderful;
import com.hummingbird.babyspace.entity.Encyclopedia;
import com.hummingbird.common.face.Pagingnation;

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

	/**
	 * 查询总记录数
	 * @param unionId 微信
	 * @param channelId 栏目
	 * @param searchKeyword 搜索条件
	 * @return
	 */
	int selectTotalCountByUnionId(@Param("unionId") String unionId,@Param("channelId") Integer channelId,@Param("searchKeyword") String searchKeyword);

	/**
	 * 查询分页结果
	 * @param unionId
	 * @param channelId
	 * @param searchKeyword
	 * @param page
	 * @return
	 */
	List<Encyclopedia> selectByUnionId(@Param("unionId")String unionId,@Param("channelId") Integer channelId,@Param("searchKeyword") String searchKeyword,@Param("page") Pagingnation page);
}