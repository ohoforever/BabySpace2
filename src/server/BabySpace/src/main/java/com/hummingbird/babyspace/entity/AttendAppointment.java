package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 候选人试听表
 */
public class AttendAppointment {
    /**
     * 候选人id
     */
    private Integer id;

    /**
     * 插入时间
     */
    private Date insertTime;

    /**
     * 预约id
     */
    private Integer candidateId;

    /**
     * 试听课程名称
     */
    private String courseName;

    /**
     * @return 候选人id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            候选人id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 插入时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            插入时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 预约id
     */
    public Integer getCandidateId() {
        return candidateId;
    }

    /**
     * @param candidateId 
	 *            预约id
     */
    public void setCandidateId(Integer candidateId) {
        this.candidateId = candidateId;
    }

    /**
     * @return 试听课程名称
     */
    public String getCourseName() {
        return courseName;
    }

    /**
     * @param courseName 
	 *            试听课程名称
     */
    public void setCourseName(String courseName) {
        this.courseName = courseName == null ? null : courseName.trim();
    }
}