package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 待开发客户评价表
 */
public class CandidateEvaluation {
    /**
     * 评价id
     */
    private Integer id;

    /**
     * 客户id
     */
    private Integer candidateId;

    /**
     * 业务员
     */
    private Integer assistantId;

    /**
     * 用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    private String level;

    /**
     * 评价时间
     */
    private Date insertTime;

    /**
     * 候选人星数,分5等,5分最高,1分最低
     */
    private Integer star;

    /**
     * 评价
     */
    private String evaluation;

    /**
     * @return 评价id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            评价id
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
     * @return 业务员
     */
    public Integer getAssistantId() {
        return assistantId;
    }

    /**
     * @param assistantId 
	 *            业务员
     */
    public void setAssistantId(Integer assistantId) {
        this.assistantId = assistantId;
    }

    /**
     * @return 用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    public String getLevel() {
        return level;
    }

    /**
     * @param level 
	 *            用户级别,A：有意向且能在一个月内到访客户,B：有意向可跟进但不能在一个月内到访客户,C：不能继续跟进无意向无经济客户,Z：被彻底放弃的客户
     */
    public void setLevel(String level) {
        this.level = level == null ? null : level.trim();
    }

    /**
     * @return 评价时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            评价时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 候选人星数,分5等,5分最高,1分最低
     */
    public Integer getStar() {
        return star;
    }

    /**
     * @param star 
	 *            候选人星数,分5等,5分最高,1分最低
     */
    public void setStar(Integer star) {
        this.star = star;
    }

    /**
     * @return 评价
     */
    public String getEvaluation() {
        return evaluation;
    }

    /**
     * @param evaluation 
	 *            评价
     */
    public void setEvaluation(String evaluation) {
        this.evaluation = evaluation == null ? null : evaluation.trim();
    }
}