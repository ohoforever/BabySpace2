package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 待开发客户开发表
 */
public class CandidateDevelop {
    /**
     * 开发id
     */
    private Integer id;

    /**
     * 客户id
     */
    private Integer candidateId;

    /**
     * 业务员,如为空表示不分配
     */
    private Integer assistantId;

    /**
     * 分配时间
     */
    private Date insertTime;

    /**
     * @return 开发id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            开发id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 客户id
     */
    public Integer getCandidateId() {
        return candidateId;
    }

    /**
     * @param candidateId 
	 *            客户id
     */
    public void setCandidateId(Integer candidateId) {
        this.candidateId = candidateId;
    }

    /**
     * @return 业务员,如为空表示不分配
     */
    public Integer getAssistantId() {
        return assistantId;
    }

    /**
     * @param assistantId 
	 *            业务员,如为空表示不分配
     */
    public void setAssistantId(Integer assistantId) {
        this.assistantId = assistantId;
    }

    /**
     * @return 分配时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            分配时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }
}