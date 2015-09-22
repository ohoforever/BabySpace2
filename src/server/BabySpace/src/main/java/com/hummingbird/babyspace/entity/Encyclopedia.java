package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 十万个为什么表
 */
public class Encyclopedia {
    /**
     * 记录id
     */
    private Integer id;

    /**
     * 栏目id,0为顶层
     */
    private Integer channel;

    /**
     * 标题
     */
    private String title;

    /**
     * 关键词,以逗号区分
     */
    private String tag;

    /**
     * 添加时间
     */
    private Date insertTime;

    /**
     * 更新时间
     */
    private Date updateTime;

    /**
     * 状态,OK#正常,FLS失败
     */
    private String status;

    /**
     * 录入人
     */
    private Integer operator;

    /**
     * 摘要
     */
    private String description;

    /**
     * 内容
     */
    private String content;

    /**
     * @return 记录id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            记录id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 栏目id,0为顶层
     */
    public Integer getChannel() {
        return channel;
    }

    /**
     * @param channel 
	 *            栏目id,0为顶层
     */
    public void setChannel(Integer channel) {
        this.channel = channel;
    }

    /**
     * @return 标题
     */
    public String getTitle() {
        return title;
    }

    /**
     * @param title 
	 *            标题
     */
    public void setTitle(String title) {
        this.title = title == null ? null : title.trim();
    }

    /**
     * @return 关键词,以逗号区分
     */
    public String getTag() {
        return tag;
    }

    /**
     * @param tag 
	 *            关键词,以逗号区分
     */
    public void setTag(String tag) {
        this.tag = tag == null ? null : tag.trim();
    }

    /**
     * @return 添加时间
     */
    public Date getInsertTime() {
        return insertTime;
    }

    /**
     * @param insertTime 
	 *            添加时间
     */
    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    /**
     * @return 更新时间
     */
    public Date getUpdateTime() {
        return updateTime;
    }

    /**
     * @param updateTime 
	 *            更新时间
     */
    public void setUpdateTime(Date updateTime) {
        this.updateTime = updateTime;
    }

    /**
     * @return 状态,OK#正常,FLS失败
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态,OK#正常,FLS失败
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
    }

    

    public Integer getOperator() {
		return operator;
	}

	public void setOperator(Integer operator) {
		this.operator = operator;
	}

	/**
     * @return 摘要
     */
    public String getDescription() {
        return description;
    }

    /**
     * @param description 
	 *            摘要
     */
    public void setDescription(String description) {
        this.description = description == null ? null : description.trim();
    }

    /**
     * @return 内容
     */
    public String getContent() {
        return content;
    }

    /**
     * @param content 
	 *            内容
     */
    public void setContent(String content) {
        this.content = content == null ? null : content.trim();
    }
}