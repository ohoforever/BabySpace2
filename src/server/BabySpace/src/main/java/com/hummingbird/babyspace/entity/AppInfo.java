package com.hummingbird.babyspace.entity;

import java.util.Date;

/**
 * 应用信息表,这里配置通知消息的来源
 */
public class AppInfo {
    private String appId;

    private String appName;

    /**
     * 用于鉴权APP的秘钥
     */
    private String appKey;

    /**
     * 用于交易鉴权用的APP证书，采用base64格式存储
     */
    private String appCert;

    private Date insertTime;

    private Date updateTime;

    /**
     * 状态，OK#-启动，STP-暂停
     */
    private String status;

    /**
     * app的公钥，采用base64存储
     */
    private String appPublicKey;

    public String getAppId() {
        return appId;
    }

    public void setAppId(String appId) {
        this.appId = appId == null ? null : appId.trim();
    }

    public String getAppName() {
        return appName;
    }

    public void setAppName(String appName) {
        this.appName = appName == null ? null : appName.trim();
    }

    /**
     * @return 用于鉴权APP的秘钥
     */
    public String getAppKey() {
        return appKey;
    }

    /**
     * @param appkey 
	 *            用于鉴权APP的秘钥
     */
    public void setAppKey(String appKey) {
        this.appKey = appKey == null ? null : appKey.trim();
    }

    /**
     * @return 用于交易鉴权用的APP证书，采用base64格式存储
     */
    public String getAppCert() {
        return appCert;
    }

    /**
     * @param appcert 
	 *            用于交易鉴权用的APP证书，采用base64格式存储
     */
    public void setAppCert(String appCert) {
        this.appCert = appCert == null ? null : appCert.trim();
    }

    public Date getInsertTime() {
        return insertTime;
    }

    public void setInsertTime(Date insertTime) {
        this.insertTime = insertTime;
    }

    public Date getUpdateTime() {
        return updateTime;
    }

    public void setUpdateTime(Date updateTime) {
        this.updateTime = updateTime;
    }

    /**
     * @return 状态，OK#-启动，STP-暂停
     */
    public String getStatus() {
        return status;
    }

    /**
     * @param status 
	 *            状态，OK#-启动，STP-暂停
     */
    public void setStatus(String status) {
        this.status = status == null ? null : status.trim();
    }

    /**
     * @return app的公钥，采用base64存储
     */
    public String getAppPublicKey() {
        return appPublicKey;
    }

    /**
     * @param apppublickey 
	 *            app的公钥，采用base64存储
     */
    public void setAppPublicKey(String appPublicKey) {
        this.appPublicKey = appPublicKey == null ? null : appPublicKey.trim();
    }
}