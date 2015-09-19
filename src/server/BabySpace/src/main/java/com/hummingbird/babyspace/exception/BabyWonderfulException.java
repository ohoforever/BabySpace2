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
public class BabyWonderfulException extends BusinessException {

	/**
	 * 订单不存在
	 */
	public static final int ERR_ORDER_NOEXIST = 1;

	public BabyWonderfulException() {
		super();
		// TODO Auto-generated constructor stub
	}

	public BabyWonderfulException(int errcode, String message, Throwable cause) {
		super(errcode, message, cause);
		// TODO Auto-generated constructor stub
	}

	public BabyWonderfulException(int errcode, String message) {
		super(errcode, message);
		// TODO Auto-generated constructor stub
	}

	public BabyWonderfulException(String message, Throwable cause) {
		super(message, cause);
		// TODO Auto-generated constructor stub
	}

	public BabyWonderfulException(String message) {
		super(message);
		// TODO Auto-generated constructor stub
	}

	public BabyWonderfulException(Throwable cause) {
		super(cause);
		// TODO Auto-generated constructor stub
	}

}
