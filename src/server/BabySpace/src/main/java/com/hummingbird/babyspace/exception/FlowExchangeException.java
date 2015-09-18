/**
 * 
 * FlowExchangeException.java
 * 版本所有 深圳市蜂鸟娱乐有限公司 2013-2014
 */
package com.hummingbird.babyspace.exception;

import com.hummingbird.common.exception.BusinessException;

/**
 * @author john huang
 * 2015年9月6日 上午10:37:05
 * 本类主要做为
 */
public class FlowExchangeException extends BusinessException{

	/**
	 * 订单异常
	 */
	public static final int ERRCODE_ORDER = 1;

	public FlowExchangeException() {
		super();
		// TODO Auto-generated constructor stub
	}

	public FlowExchangeException(int errcode, String message, Throwable cause) {
		super(errcode, message, cause);
		// TODO Auto-generated constructor stub
	}

	public FlowExchangeException(int errcode, String message) {
		super(errcode, message);
		// TODO Auto-generated constructor stub
	}

	public FlowExchangeException(String message, Throwable cause) {
		super(message, cause);
		// TODO Auto-generated constructor stub
	}

	public FlowExchangeException(String message) {
		super(message);
		// TODO Auto-generated constructor stub
	}

	public FlowExchangeException(Throwable cause) {
		super(cause);
		// TODO Auto-generated constructor stub
	}

}
