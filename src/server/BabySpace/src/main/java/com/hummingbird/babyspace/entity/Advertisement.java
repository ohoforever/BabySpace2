package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 广告表
 */
public class Advertisement {
    /**
     * 广告id
     */
    private Integer id;

    /**
     * 标题
     */
    private String title;

    /**
     * 广告分类,ZAJ早教
     */
    private String type;

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
     * 状态,CRT创建, OK#正常(上线),OFF 下线
     */
    private String status;

    /**
     * 录入人
     */
    private Integer operator;

    /**
     * 跳转地址
     */
    private String url;

    /**
     * 摘要
     */
    private String description;

    /**
     * 内容
     */
    private String content;

    /**
     * @return 广告id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            广告id
     */
    public void setId(Integer id) {
        this.id = id;
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
     * @return 广告分类,ZAJ早教
     */
    public String getType() {
        return type;
    }

    /**
     * @param type 
	 *            广告分类,ZAJ早教
     */
    public void setType(String type) {
        this.type = type == null ? null : type.trim();
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
     * @return 状态,CRT创建, OK#正常(上线),OFF 下线
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态,CRT创建, OK#正常(上线),OFF 下线
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
    }

    /**
     * @return 录入人
     */
    public Integer getOperator() {
        return operator;
    }

    /**
     * @param operator 
	 *            录入人
     */
    public void setOperator(Integer operator) {
        this.operator = operator;
    }

    /**
     * @return 跳转地址
     */
    public String getUrl() {
        return url;
    }

    /**
     * @param url 
	 *            跳转地址
     */
    public void setUrl(String url) {
        this.url = url == null ? null : url.trim();
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