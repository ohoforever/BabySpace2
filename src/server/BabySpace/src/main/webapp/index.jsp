<%@ page language="java" import="java.util.*" pageEncoding="utf-8"%>
<%
String path = request.getContextPath();
String basePath = request.getScheme()+"://"+request.getServerName()+":"+request.getServerPort()+path+"/";
%>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <base href="<%=basePath%>">
    
    <title>My JSP 'index.jsp' starting page</title>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">    
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">
	<meta http-equiv="description" content="This is my page">
	<script src="<%=path%>/js/jquery-1.11.1.js"></script>
	<style type="text/css">
	.menu li{
		display: inline-block;
	}
	</style>
  </head>
  <body>
  	<div>
	<ul>
	<li><label>服务器</label>
	<select name="host" id="host">
	<option value="http://<%=request.getServerName()%>:<%=request.getServerPort()%><%=request.getContextPath() %>" selected>当前服务器地址</option>
	</select><input type='txt' id='realhost' >
	<li><label>接口名</label>
	<textarea id='api' cols="60"></textarea>

	</li>
	<li><label>参数</label><textarea id="param" cols="100" rows="15"></textarea></li>
	<li><label>cookie</label><textarea id="cookie" cols="100" rows="2"></textarea></li>
	<li><input type="button" value="提交" id="bt"></li>
	<li><label>响应</label><div id="resp"></div></li>
	</ul>
	</div>
	<ul id="menu">
		<li><input type="button"   onclick='setbinding("/rc/exchange/queryTelFlowProduct","{\"app\":{\"appId\":\"ADP\",\"timeStamp\":\"TIMESTAMP\",  \"nonce\":\"NONCE\", \"signature\":\"SIGNATURE\"  },\"body\":  {\"mobileNum\":\"13912345678\",\"maxFee\":5000}}")' value="查询可用产品" ></li>
		<li><input type="button"   onclick='setbinding("/rc/exchange/transfer_to_tel_flow","{\"app\":{\"appId\":\"ADP\",\"timeStamp\":\"TIMESTAMP\",  \"nonce\":\"NONCE\", \"signature\":\"SIGNATURE\"  },\"body\":  {\"mobileNum\":\"13912345678\",\"productId\":1,\"appOrderId\":\"abc12345\"},\"tsig\":{\"orderMD5\":\"ORDERMD5\",\"signature\":\"SIGNATURE\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\"}}")' value="申请兑换" ></li>
		<li><input type="button"   onclick='setbinding("/rc/exchange/query_tel_flow_result","{\"app\":{\"appId\":\"ADP\",\"timeStamp\":\"TIMESTAMP\",  \"nonce\":\"NONCE\", \"signature\":\"SIGNATURE\"  },\"body\":  {\"appOrderId\":\"abc12345\"}}")' value="查询兑换结果" ></li> 
		<li><input type="button"   onclick='setbinding("/rc/exchange/tel_flow_result_notify","{\"orderNo\":\"EX201509090000000000\",\"partnerOrderNo\": \"12345\", \"status\":\"1\"}")' value="兑换结果通知" ></li> 
	<br>

<!-- <li><input type="button"   onclick='setbinding("/userAuth/get_accountcode","{\"app\":{\"appId\":\"zjhtwallet\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\",\"signature\":\"b94490aecabf04eba1e9ab58dc76c115\"},\"mobileNum\":\"18922260815\"}")' value="获取账户验证码" ></li>
<li><input type="button"   onclick='setbinding("/userAuth/set_paymentcode","{\"app\":{\"appId\":\"zjhtwallet\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\",\"signature\":\"b94490aecabf04eba1e9ab58dc76c115\"},\"mobileNum\":\"18922260815\",\"accountCode\":\"123456\",\"paymentCodeMD5\":\"qwer1234567\"}")' value="设置支付密码" ></li>
<li><input type="button"   onclick='setbinding("/userAuth/genkey","{\"app\":{\"appId\":\"zjhtwallet\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\",\"signature\":\"73ef10be2e08a0ad541d28fbe99a0df4\"},\"order\":{\"mobileNum\":\"13912345678\",\"objectSum\":500000,\"productName\":\"有油贷5000元产品\",\"remark\":\"在有油贷网站够爱5000元有油贷产品\",\"appOrderId\":\"AO201412122344888444\"},\"tsig\":{\"orderMD5\":\"ORDERMD5\",\"signature\":\"SIGNATURE\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\"}}")' value="生成key" ></li>
<li><input type="button"   onclick='setbinding4string("/userAuth/genParam","{\"app\":{\"appId\":\"zjhtwallet\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\",\"signature\":\"73ef10be2e08a0ad541d28fbe99a0df4\"},\"order\":{\"mobileNum\":\"13912345678\",\"objectSum\":500000,\"productName\":\"有油贷5000元产品\",\"remark\":\"在有油贷网站够爱5000元有油贷产品\",\"appOrderId\":\"AO201412122344888444\"},\"tsig\":{\"orderMD5\":\"ORDERMD5\",\"signature\":\"SIGNATURE\",\"timeStamp\":\"TIMESTAMP\",\"nonce\":\"NONCE\"}}")' value="生成签名" ></li>
<li><input type="button"   onclick='setbinding("/sms/send","{\"user\":\"test\",\"password\":\"smst\",\"mobileNum\":\"18922260815\",\"content\":\"测试\"}")' value="短信发送" ></li>
  --></ul> 
  </body>
    <script>
    var type='payload'
    
		$("#bt").click(function (){
			$("#resp").html("");
			var hostval = $("#realhost").val()
			if(hostval==''){
				hostval=$("#host").val()
			}
			var url =hostval+$("#api").val();
			var data = $("#param").val();
			if(type=='payload')
			{
				var vcookie = $('#cookie').val();
				if(vcookie!=''){
					try{
						vcookie = eval('('+vcookie+')');
						for(item in vcookie){
							$.cookie(item, vcookie[item]);
						}
					}
					catch(e){console.print(e)}
					
				}
				
				$.ajax({type:'POST',contentType:'application/json',url:url,data:data,
				success:function(resp){ $("#resp").text(resp);},dataType:"html"}
				);
			}
			else if(type=='cookie'){
				data = eval('('+data+')');
				for(item in data){
					$.cookie(item, data[item]);
				}
				$.ajax({type:'POST',contentType:'application/json',url:url,
					success:function(resp){ $("#resp").text(resp);},dataType:"html"}
					);
			}
			else if(type=='formdata'){
				data = eval('('+data+')');
				$.ajax({type:'POST',url:url,data:data,
					success:function(resp){ $("#resp").text(resp);},dataType:"html"}
				);
			}
			else if(type=='string'){
				//以string 的形式提交，参数名为param
				$.ajax({type:'POST',url:url,data:{param:data},
					success:function(resp){ $("#resp").text(resp);},dataType:"html"}
					);
			}
			else if(type=='xml'){
				$.ajax({type:'POST',contentType:'application/xml',url:url,data:data,
					success:function(resp){ 
						var str = serializeXml(resp)
						$("#resp").text(str);
					},dataType:"xml"});
			}
			
		});
		
    function setbinding4string(api,json){
    	setbinding(api,json,null,'string');
    }
    
		function setbinding(api,json,cookiejson,submittype){
			$("#api").val(api)
			$("#param").val(json.replace("\$\{systime\}",new Date().getTime()))
			$("#cookie").val(cookiejson)
			if(!submittype){
				submittype= 'payload';
			}
			type=submittype;
		}
		
		jQuery.cookie = function(name, value, options) {
			if (typeof value != 'undefined') {
			   options = options || {};
			   if (value === null) {
			    value = '';
			    options = $.extend({}, options);
			    options.expires = -1;
			   }
			   var expires = '';
			   if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
			    var date;
			    if (typeof options.expires == 'number') {
			     date = new Date();
			     date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
			    } else {
			     date = options.expires;
			    }
			    expires = '; expires=' + date.toUTCString();
			   }
			   var path = options.path ? '; path=' + (options.path) : '';
			   var domain = options.domain ? '; domain=' + (options.domain) : '';
			   var secure = options.secure ? '; secure' : '';
			   document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
			} else {
			   var cookieValue = null;
			   if (document.cookie && document.cookie != '') {
			    var cookies = document.cookie.split(';');
			    for (var i = 0; i < cookies.length; i++) {
			     var cookie = jQuery.trim(cookies[i]);
			     if (cookie.substring(0, name.length + 1) == (name + '=')) {
			      cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
			      break;
			     }
			    }
			   }
			   return cookieValue;
			}
			};
			
			function setbinding_cookie(api,json){
				$("#api").val(api)
				$("#param").val(json)
				type = 'cookie';
				
			}
			
		    function setbinding4xml(api,json){
		    	setbinding(api,json,null,'xml');
		    }
		
	</script>
  
</html>
