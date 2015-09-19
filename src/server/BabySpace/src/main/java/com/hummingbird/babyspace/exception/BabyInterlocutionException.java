/**
 * 
 * BabyWonderfulException.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.exception;

import com.hummingbird.common.exception.BusinessException;

/**
 * @author john huang
 * 2015年9月19日 下午4:22:13
 * 本类主要做为
 */
public class BabyInterlocutionException extends BusinessException {

	/**
	 * 订单异常
	 */
	public static final int ERR_ORDER = 1;

	public BabyInterlocutionException() {
		super();
		// TODO Auto-generated constructor stub
	}

	public BabyInterlocutionException(int errcode, String message, Throwable cause) {
		super(errcode, message, cause);
		// TODO Auto-generated constructor stub
	}

	public BabyInterlocutionException(int errcode, String message) {
		super(errcode, message);
		// TODO Auto-generated constructor stub
	}

	public BabyInterlocutionException(String message, Throwable cause) {
		super(message, cause);
		// TODO Auto-generated constructor stub
	}

	public BabyInterlocutionException(String message) {
		super(message);
		// TODO Auto-generated constructor stub
	}

	public BabyInterlocutionException(Throwable cause) {
		super(cause);
		// TODO Auto-generated constructor stub
	}

}
