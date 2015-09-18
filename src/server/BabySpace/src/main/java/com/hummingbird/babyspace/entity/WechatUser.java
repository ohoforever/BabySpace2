package com.hummingbird.babyspace.entity;

import java.util.Date;

public class WechatUser {
    private Integer userid;

    /**
     * 用户的标识，对当前公众号唯一
     */
    private String openid;

    /**
     * 微信昵称
     */
    private String nickname;

    /**
     * 性别
     */
    private Byte sex;

    /**
     * 语言
     */
    private String language;

    /**
     * 城市
     */
    private String city;

    /**
     * 省份
     */
    private String province;

    /**
     * 国家
     */
    private String country;

    /**
     * 头像地址
     */
    private String headimgurl;

    /**
     * 关注时间
     */
    private Integer subscribeTime;

    /**
     * 微信用户的唯一标识,只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段. 
     */
    private String unionid;

    /**
     * 公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
     */
    private String remark;

    /**
     * 是否关注的标识 -1从未关注过 0 未关注 1已关注
     */
    private Byte subscribe;

    /**
     * 用户所在的分组ID
     */
    private Integer groupid;

    private Date addTime;

    /**
     * 更新时间
     */
    private Date updateTime;

    /**
     * 二维码ticket
     */
    private String qrTicket;

    /**
     * 二维码的有效时间，以秒为单位
     */
    private Integer qrExpireSeconds;

    /**
     * 二维码ticket创建时间
     */
    private Integer qrCreateTime;

    /**
     * 用户特征信息
     */
    private String privilege;

    public Integer getUserid() {
        return userid;
    }

    public void setUserid(Integer userid) {
        this.userid = userid;
    }

    /**
     * @return 用户的标识，对当前公众号唯一
     */
    public String getOpenid() {
        return openid;
    }

    /**
     * @param openid 
	 *            用户的标识，对当前公众号唯一
     */
    public void setOpenid(String openid) {
        this.openid = openid == null ? null : openid.trim();
    }

    /**
     * @return 微信昵称
     */
    public String getNickname() {
        return nickname;
    }

    /**
     * @param nickname 
	 *            微信昵称
     */
    public void setNickname(String nickname) {
        this.nickname = nickname == null ? null : nickname.trim();
    }

    /**
     * @return 性别
     */
    public Byte getSex() {
        return sex;
    }

    /**
     * @param sex 
	 *            性别
     */
    public void setSex(Byte sex) {
        this.sex = sex;
    }

    /**
     * @return 语言
     */
    public String getLanguage() {
        return language;
    }

    /**
     * @param language 
	 *            语言
     */
    public void setLanguage(String language) {
        this.language = language == null ? null : language.trim();
    }

    /**
     * @return 城市
     */
    public String getCity() {
        return city;
    }

    /**
     * @param city 
	 *            城市
     */
    public void setCity(String city) {
        this.city = city == null ? null : city.trim();
    }

    /**
     * @return 省份
     */
    public String getProvince() {
        return province;
    }

    /**
     * @param province 
	 *            省份
     */
    public void setProvince(String province) {
        this.province = province == null ? null : province.trim();
    }

    /**
     * @return 国家
     */
    public String getCountry() {
        return country;
    }

    /**
     * @param country 
	 *            国家
     */
    public void setCountry(String country) {
        this.country = country == null ? null : country.trim();
    }

    /**
     * @return 头像地址
     */
    public String getHeadimgurl() {
        return headimgurl;
    }

    /**
     * @param headimgurl 
	 *            头像地址
     */
    public void setHeadimgurl(String headimgurl) {
        this.headimgurl = headimgurl == null ? null : headimgurl.trim();
    }

    /**
     * @return 关注时间
     */
    public Integer getSubscribeTime() {
        return subscribeTime;
    }

    /**
     * @param subscribeTime 
	 *            关注时间
     */
    public void setSubscribeTime(Integer subscribeTime) {
        this.subscribeTime = subscribeTime;
    }

    /**
     * @return 微信用户的唯一标识,只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段. 
     */
    public String getUnionid() {
        return unionid;
    }

    /**
     * @param unionid 
	 *            微信用户的唯一标识,只有在用户将公众号绑定到微信开放平台帐号后，才会出现该字段. 
     */
    public void setUnionid(String unionid) {
        this.unionid = unionid == null ? null : unionid.trim();
    }

    /**
     * @return 公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
     */
    public String getRemark() {
        return remark;
    }

    /**
     * @param remark 
	 *            公众号运营者对粉丝的备注，公众号运营者可在微信公众平台用户管理界面对粉丝添加备注
     */
    public void setRemark(String remark) {
        this.remark = remark == null ? null : remark.trim();
    }

    /**
     * @return 是否关注的标识 -1从未关注过 0 未关注 1已关注
     */
    public Byte getSubscribe() {
        return subscribe;
    }

    /**
     * @param subscribe 
	 *            是否关注的标识 -1从未关注过 0 未关注 1已关注
     */
    public void setSubscribe(Byte subscribe) {
        this.subscribe = subscribe;
    }

    /**
     * @return 用户所在的分组ID
     */
    public Integer getGroupid() {
        return groupid;
    }

    /**
     * @param groupid 
	 *            用户所在的分组ID
     */
    public void setGroupid(Integer groupid) {
        this.groupid = groupid;
    }

    public Date getAddTime() {
        return addTime;
    }

    public void setAddTime(Date addTime) {
        this.addTime = addTime;
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
     * @return 二维码ticket
     */
    public String getQrTicket() {
        return qrTicket;
    }

    /**
     * @param qrTicket 
	 *            二维码ticket
     */
    public void setQrTicket(String qrTicket) {
        this.qrTicket = qrTicket == null ? null : qrTicket.trim();
    }

    /**
     * @return 二维码的有效时间，以秒为单位
     */
    public Integer getQrExpireSeconds() {
        return qrExpireSeconds;
    }

    /**
     * @param qrExpireSeconds 
	 *            二维码的有效时间，以秒为单位
     */
    public void setQrExpireSeconds(Integer qrExpireSeconds) {
        this.qrExpireSeconds = qrExpireSeconds;
    }

    /**
     * @return 二维码ticket创建时间
     */
    public Integer getQrCreateTime() {
        return qrCreateTime;
    }

    /**
     * @param qrCreateTime 
	 *            二维码ticket创建时间
     */
    public void setQrCreateTime(Integer qrCreateTime) {
        this.qrCreateTime = qrCreateTime;
    }

    /**
     * @return 用户特征信息
     */
    public String getPrivilege() {
        return privilege;
    }

    /**
     * @param privilege 
	 *            用户特征信息
     */
    public void setPrivilege(String privilege) {
        this.privilege = privilege == null ? null : privilege.trim();
    }
}