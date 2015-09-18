package com.hummingbird.babyspace.entity;

/**
 * 十万个为什么栏目表
 */
public class EncyclopediaChannel {
    /**
     * 栏目id
     */
    private Integer id;

    /**
     * 栏目名称
     */
    private String channelName;

    /**
     * 父栏目,为0时代表为顶层栏目
     */
    private Integer parentId;

    /**
     * @return 栏目id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            栏目id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 栏目名称
     */
    public String getChannelName() {
        return channelName;
    }

    /**
     * @param channelName 
	 *            栏目名称
     */
    public void setChannelName(String channelName) {
        this.channelName = channelName == null ? null : channelName.trim();
    }

    /**
     * @return 父栏目,为0时代表为顶层栏目
     */
    public Integer getParentId() {
        return parentId;
    }

    /**
     * @param parentId 
	 *            父栏目,为0时代表为顶层栏目
     */
    public void setParentId(Integer parentId) {
        this.parentId = parentId;
    }
}