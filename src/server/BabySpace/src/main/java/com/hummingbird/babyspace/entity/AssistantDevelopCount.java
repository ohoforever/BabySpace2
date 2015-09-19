package com.hummingbird.babyspace.entity;

/**
 * 业务员开发记录表
 */
public class AssistantDevelopCount {
    /**
     * 业务员id
     */
    private Integer id;

    /**
     * 开发客户数
     */
    private Integer developingCount;

    /**
     * 开发完成数
     */
    private Integer developedCount;

    /**
     * @return 业务员id
     */
    public Integer getId() {
        return id;
    }

    /**
     * @param id 
	 *            业务员id
     */
    public void setId(Integer id) {
        this.id = id;
    }

    /**
     * @return 开发客户数
     */
    public Integer getDevelopingCount() {
        return developingCount;
    }

    /**
     * @param developingCount 
	 *            开发客户数
     */
    public void setDevelopingCount(Integer developingCount) {
        this.developingCount = developingCount;
    }

    /**
     * @return 开发完成数
     */
    public Integer getDevelopedCount() {
        return developedCount;
    }

    /**
     * @param developedCount 
	 *            开发完成数
     */
    public void setDevelopedCount(Integer developedCount) {
        this.developedCount = developedCount;
    }
}