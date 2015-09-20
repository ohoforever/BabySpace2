/**
 * 
 * BabyInterlocutionSubmitQuestion.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.vo;

/**
 * @author john huang
 * 2015年9月19日 下午5:22:34
 * 本类主要做为 长成时光详情vo
 */
public class BabyMatureDetailVO extends RecordIdGetDetailVO {

	public void setMatureId(Integer matureId){
		setRecordId(matureId);
	}
	
	public Integer getMatureId(){
		return getRecordId();
	}

	/* (non-Javadoc)
	 * @see java.lang.Object#toString()
	 */
	@Override
	public String toString() {
		return "BabyMatureDetailVO [getMatureId()=" + getMatureId() + "]";
	}
	
	
	
	
}
