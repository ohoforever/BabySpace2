package com.hummingbird.babyspace.mapper;

import java.util.List;

import com.hummingbird.babyspace.entity.BabyMatureComment;

public interface BabyMatureCommentMapper {
    /**
     * 根据主键删除记录
     */
    int deleteByPrimaryKey(Integer id);

    /**
     * 保存记录,不管记录里面的属性是否为空
     */
    int insert(BabyMatureComment record);

    /**
     * 保存属性不为空的记录
     */
    int insertSelective(BabyMatureComment record);

    /**
     * 根据主键查询记录
     */
    BabyMatureComment selectByPrimaryKey(Integer id);

    /**
     * 根据主键更新属性不为空的记录
     */
    int updateByPrimaryKeySelective(BabyMatureComment record);

    /**
     * 根据主键更新记录
     */
    int updateByPrimaryKey(BabyMatureComment record);

	/**
	 * 查询成长时光评论列表
	 * @param id
	 * @return
	 */
	List<BabyMatureComment> selectComments(Integer  matureId);
}