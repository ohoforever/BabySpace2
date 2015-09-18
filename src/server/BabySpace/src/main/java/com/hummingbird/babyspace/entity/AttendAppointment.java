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
     * 家长手机号
     */
    private Date insertTime;

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
     * @return 家长手机号
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            家长手机号
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }
}