package com.hummingbird.babyspace.services;

public interface CommonService {
/**
 * @Description 分享
 * @param unionId
 * @param type
 * @param orderId
 */
public void share(String unionId,String type,Integer recordId);
/**
 * @Description 点赞
 * @param unionId
 * @param type
 * @param orderId
 */
public void praise(String unionId,String type,Integer recordId);
}
