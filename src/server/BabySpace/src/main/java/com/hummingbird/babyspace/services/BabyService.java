package com.hummingbird.babyspace.services;

import java.util.List;

import com.hummingbird.babyspace.entity.Child;

public interface BabyService {
/**
 * 查询宝宝接口
 * @param unionId
 * @return
 */
 public List<Child> queryBabyByUnionId(String unionId,String mobileNum);
}
