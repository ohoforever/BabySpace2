<?php
/**
 * 通过swoole启动接口服务
 * @author xuebingwang <406964108@qq.com>
 */
date_default_timezone_set('PRC');
define ('DS', DIRECTORY_SEPARATOR);
define ('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define ('APP_PATH', ROOT_PATH.DS.'application'.DS);
define ('CONF_PATH', '/var/www/html/conf/baby/');
define ('DOMAIN','http://mm.mi360.me');

register_shutdown_function('handleFatal');
function handleFatal()
{

    SeasLog::setLogger('api/error');
    
    $error = error_get_last();
    if (isset($error['type']))
    {
        switch ($error['type'])
        {
        	case E_ERROR :
        	case E_PARSE :
        	case E_DEPRECATED:
        	case E_CORE_ERROR :
        	case E_COMPILE_ERROR :
        	    $message = $error['message'];
        	    $file = $error['file'];
        	    $line = $error['line'];
        	    $log = "$message ($file:$line)\nStack trace:\n";
        	    $trace = debug_backtrace();
        	    foreach ($trace as $i => $t)
        	    {
        	        if (!isset($t['file']))
        	        {
        	            $t['file'] = 'unknown';
        	        }
        	        if (!isset($t['line']))
        	        {
        	            $t['line'] = 0;
        	        }
        	        if (!isset($t['function']))
        	        {
        	            $t['function'] = 'unknown';
        	        }
        	        $log .= "#$i {$t['file']}({$t['line']}): ";
        	        if (isset($t['object']) && is_object($t['object']))
        	        {
        	            $log .= get_class($t['object']) . '->';
        	        }
        	        $log .= "{$t['function']}()\n";
        	    }
        	    if (isset($_SERVER['REQUEST_URI']))
        	    {
        	        $log .= '[QUERY] ' . $_SERVER['REQUEST_URI'];
        	    }

        	    SeasLog::error($log);
        }
    }
}

class HttpServer
{
    /**
     * 实例
     * @var TcpServer
     */
	public static $instance;

	/**
	 * swoole的tcp_server
	 * @var $server
	 */
	public static $server;
	
	public $request;
	
	public $response;
	
	/**
	 * Yaf Application
	 * @var  Yaf\Application 
	 */
	private $application;

	/**
	 * 构造方法，要执行的东西很多
	 * @author xuebing<406964108@qq.com>
	 */
	public function __construct() {

	    $config = new Yaf\Config\Ini(CONF_PATH.'swoole.ini');
	    $config = $config->get('swoole');
	    
        self::$server = new swoole_http_server("0.0.0.0", $config->server->port);
        
		self::$server->set(
			array(
				'worker_num'            => $config->worker_num,         //worker进程数 
//                 'max_conn'              => $config->max_conn,           //最大允许的连接数， 此参数用来设置Server最大允许维持多少个tcp连接。超过此数量后，新进入的连接将被拒绝。
//                 'max_request'           => $config->max_request,        //此参数表示worker进程在处理完n次请求后结束运行。manager会重新创建一个worker进程。此选项用来防止worker进程内存溢出。
                'ipc_mode'              => $config->ipc_mode,           // 1，默认项，使用Unix Socket作为进程间通信,2，使用系统消息队列作为进程通信方式
                'task_worker_num'       => $config->task_worker_num,    //task_worker进程数 
                'task_ipc_mode'         => $config->task_ipc_mode,      //1, 使用unix socket通信，2, 使用消息队列通信，3, 使用消息队列通信，并设置为争抢模式
                'task_max_request'      => $config->task_max_request,   //设置task进程的最大任务数
                'dispatch_mode'         => $config->dispatch_mode,      //1平均分配，2按FD取摸固定分配，3抢占式分配，默认为取摸(dispatch=2)
                'daemonize'             => $config->daemonize,          //守护进程化
                'backlog'               => $config->backlog,            //最多同时有多少个等待accept的连接
                'open_tcp_keepalive'    => $config->open_tcp_keepalive, //启用tcp keepalive
                'tcp_defer_accept'      => $config->tcp_defer_accept,   //当一个TCP连接有数据发送时才触发accept
                'open_tcp_nodelay'      => $config->open_tcp_nodelay,   //开启后TCP连接发送数据时会无关闭Nagle合并算法，立即发往客户端连接。在某些场景下，如http服务器，可以提升响应速度。 
                'log_file'              => ROOT_PATH . '/runtime/log/server_mall.log', //日志文件路径
                //'task_tmpdir'         => APP_PATH . '/data/task',
			)
		);

		self::$server->on('request', function($request, $response) {

		    $this->request = $request;
		    $this->response = $response;
		    
		    $this->setGlobal();

            //正式环境去掉这句
// 		    self::$server->reload();

            $raw_data = $request->rawContent();

		    SeasLog::setLogger('api/baby_server');

            $this->my_log("请求地址==>".$request->server['request_uri']);
            $this->my_log("请求内容==>".$raw_data);

            if($raw_data == 'swoole reload'){
		        self::$server->reload();
        		$response->end('reload success');
		        return;
		    }

            $array = explode('/',$request->server['request_uri']);
            if(count($array) != 4){
                $response->end('"errcode":10000,"errmsg":"请求地址不正确!"}');
                return;
            }

            list($null,$module,$controller,$action) = $array;

    		ob_start();
    		try {
    		    $yaf_request = new Yaf\Request\Simple('CLI',$module,$controller,$action,['raw_data'=>$raw_data]);
    		    $this->application->getDispatcher()->dispatch($yaf_request);

                // unset(Yaf\Application::app());
                $result = ob_get_contents();
            } catch (\Exception $e ) {

                $result = $e->getMessage();
            }


            ob_end_clean();

    		// add Header
    		 
    		// add cookies
    		 
    		// set status
    		$this->my_log('返回内容==>'.$result);
    		
    		$response->end($result);
    	});

        self::$server->on('Finish', function($serv, $task_id, $data) {
            
            $this->my_log("异步任务完成[{$task_id}],data:".$data);
        });
    
        self::$server->on('Task', function($serv, $task_id, $from_id, $data) {

            SeasLog::setLogger('api/baby_server');
            
            $this->my_log("异步任务[来自进程 {$from_id}，当前进程 {$task_id}]");
            
//             $data = unserialize($data);
            if(is_array($data)){
                list($module,$controller,$action,$params) = $data;
                $this->my_log("$module/$controller/$action");
                
                $request = new Yaf\Request\Simple('CLI', $module, $controller, $action, $params);
                $this->application->getDispatcher()->dispatch($request);
                $serv->finish("task -> OK");
            }
        });
        
        self::$server->on('Timer', function($serv, $interval) {
            switch ($interval) {
            	case 300000:
            	    break;
            }
        });
        
        self::$server->on('Start', function($serv) {
            echo 'Swoole Wechat Http Server Start. Version:'.SWOOLE_VERSION.PHP_EOL;
            if(extension_loaded('Zend OPcache')){
                opcache_reset();
            }
            cli_set_process_title("swoole_mall:main");
        });

        self::$server->on('WorkerStart' , array($this,'onWorkerStart'));
        
        self::$server->on('ManagerStart', function($serv) {
            cli_set_process_title("swoole_mall:manager");
        });
        
        self::$server->on('Shutdown', function($serv) {
               echo 'SHutdown'.PHP_EOL;
        });
        
        self::$server->on('WorkerError', function($serv, $worker_id, $worker_pid, $exit_code) {
        });

        
		self::$server->start();
	}
	
	public function onWorkerStart($serv, $worker_id) {

	    $this->application = new Yaf\Application (CONF_PATH. 'application.ini', 'product');
	    $this->application->bootstrap();
        if(extension_loaded('Zend OPcache')){
	        opcache_reset();
        }
	    if ($worker_id >= $serv->setting['worker_num']) {
	        cli_set_process_title("swoole_mall:task_worker");
	    } else {
	        cli_set_process_title("swoole_mall:worker");
	    }
	    //$serv->addtimer(300000);
	}

	private function my_log($msg){
	    SeasLog::debug($msg);
	}

	public static function getInstance() {
		if (!self::$instance) {
            self::$instance = new HttpServer;
        }
        return self::$instance;
	}
	
	function setGlobal(){
	    if (isset($this->request->get)){
	        $_GET = $this->request->get;
	    }else{
	        $_GET = array();
	    }
	    
	    if (isset($this->request->post)){
	        $_POST = $this->request->post;
	    }else{
	        $_POST = array();
	    }
	    
	    if (isset($this->request->files)){
	        $_FILES = $this->request->files;
	    }else{
	        $_FILES = array();
	    }
	    
	    if (isset($this->request->cookie)){
	        $_COOKIE = $this->request->cookie;
	    }else{
	        $_COOKIE = array();
	    }
	    
	    if (isset($this->request->server)){
	        $_SERVER = $this->request->server;
	    }else{
	        $_SERVER = array();
	    }
	    
	    $_REQUEST = array_merge($_GET, $_POST, $_COOKIE);
	    $_SERVER['REQUEST_URI'] = $this->request->server['request_uri'];
	    /**
	     * 将HTTP头信息赋值给$_SERVER超全局变量
	     */
	    foreach($this->request->header as $key => $value)
	    {
	        $_key = 'HTTP_'.strtoupper(str_replace('-', '_', $key));
	        $_SERVER[$_key] = $value;
	    }
	    $_SERVER['REMOTE_ADDR'] = $this->request->server['remote_addr'];
	}
}

HttpServer::getInstance();
