package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 宝贝精彩表
 */
public class BabyWonderful {
    /**
     * 记录id
     */
    private Integer id;

    /**
     * 内容
     */
    private String content;

    /**
     * 标题
     */
    private String title;

    /**
     * 关键词,以逗号区分
     */
    private String tag;

    /**
     * 照片1
     */
    private String image1;

    /**
     * 照片2
     */
    private String image2;

    /**
     * 照片3
     */
    private String image3;

    /**
     * 照片4
     */
    private String image4;

    /**
     * 照片5
     */
    private String image5;

    /**
     * 照片6
     */
    private String image6;

    /**
     * 照片7
     */
    private String image7;

    /**
     * 照片8
     */
    private String image8;

    /**
     * 照片9
     */
    private String image9;

    /**
     * 点赞数
     */
    private Integer likeCount;

    /**
     * 活动时间
     */
    private Date actTime;

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
     * 分享标题
     */
    private String shareTitle;

    /**
     * 分享图片下标,由0开始,它不能大于已上传的照片
     */
    private Integer shareImgIndex;

    /**
     * 分享内容
     */
    private String shareContent;

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
     * @return 照片1
     */
    public String getImage1() {
        return image1;
    }

    /**
     * @param image1 
	 *            照片1
     */
    public void setImage1(String image1) {
        this.image1 = image1 == null ? null : image1.trim();
    }

    /**
     * @return 照片2
     */
    public String getImage2() {
        return image2;
    }

    /**
     * @param image2 
	 *            照片2
     */
    public void setImage2(String image2) {
        this.image2 = image2 == null ? null : image2.trim();
    }

    /**
     * @return 照片3
     */
    public String getImage3() {
        return image3;
    }

    /**
     * @param image3 
	 *            照片3
     */
    public void setImage3(String image3) {
        this.image3 = image3 == null ? null : image3.trim();
    }

    /**
     * @return 照片4
     */
    public String getImage4() {
        return image4;
    }

    /**
     * @param image4 
	 *            照片4
     */
    public void setImage4(String image4) {
        this.image4 = image4 == null ? null : image4.trim();
    }

    /**
     * @return 照片5
     */
    public String getImage5() {
        return image5;
    }

    /**
     * @param image5 
	 *            照片5
     */
    public void setImage5(String image5) {
        this.image5 = image5 == null ? null : image5.trim();
    }

    /**
     * @return 照片6
     */
    public String getImage6() {
        return image6;
    }

    /**
     * @param image6 
	 *            照片6
     */
    public void setImage6(String image6) {
        this.image6 = image6 == null ? null : image6.trim();
    }

    /**
     * @return 照片7
     */
    public String getImage7() {
        return image7;
    }

    /**
     * @param image7 
	 *            照片7
     */
    public void setImage7(String image7) {
        this.image7 = image7 == null ? null : image7.trim();
    }

    /**
     * @return 照片8
     */
    public String getImage8() {
        return image8;
    }

    /**
     * @param image8 
	 *            照片8
     */
    public void setImage8(String image8) {
        this.image8 = image8 == null ? null : image8.trim();
    }

    /**
     * @return 照片9
     */
    public String getImage9() {
        return image9;
    }

    /**
     * @param image9 
	 *            照片9
     */
    public void setImage9(String image9) {
        this.image9 = image9 == null ? null : image9.trim();
    }

    /**
     * @return 点赞数
     */
    public Integer getLikeCount() {
        return likeCount;
    }

    /**
     * @param likeCount 
	 *            点赞数
     */
    public void setLikeCount(Integer likeCount) {
        this.likeCount = likeCount;
    }

    /**
     * @return 活动时间
     */
    public Date getActTime() {
        return actTime;
    }

    /**
     * @param actTime 
	 *            活动时间
     */
    public void setActTime(Date actTime) {
        this.actTime = actTime;
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
     * @return 分享标题
     */
    public String getShareTitle() {
        return shareTitle;
    }

    /**
     * @param shareTitle 
	 *            分享标题
     */
    public void setShareTitle(String shareTitle) {
        this.shareTitle = shareTitle == null ? null : shareTitle.trim();
    }

    /**
     * @return 分享图片下标,由0开始,它不能大于已上传的照片
     */
    public Integer getShareImgIndex() {
        return shareImgIndex;
    }

    /**
     * @param shareImgIndex 
	 *            分享图片下标,由0开始,它不能大于已上传的照片
     */
    public void setShareImgIndex(Integer shareImgIndex) {
        this.shareImgIndex = shareImgIndex;
    }

    /**
     * @return 分享内容
     */
    public String getShareContent() {
        return shareContent;
    }

    /**
     * @param shareContent 
	 *            分享内容
     */
    public void setShareContent(String shareContent) {
        this.shareContent = shareContent == null ? null : shareContent.trim();
    }
}