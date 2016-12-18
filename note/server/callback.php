<?php

/**
事件执行顺序

所有事件回调均在$server->start后发生
服务器关闭程序终止时最后一次事件是onShutdown
服务器启动成功后，onStart/onManagerStart/onWorkerStart会在不同的进程内并发执行。
onReceive/onConnect/onClose/onTimer在worker进程(包括task进程)中各自触发
worker/task进程启动/结束时会分别调用onWorkerStart/onWorkerStop
onTask事件仅在task进程中发生
onFinish事件仅在worker进程中发生
onStart/onManagerStart/onWorkerStart 3个事件的执行顺序是不确定的
异常捕获

swoole不支持 set_exception_handler函数
如果你的PHP代码有抛出异常逻辑，必须在事件回调函数顶层进行try/catch来捕获异常
$serv->on('Timer', function() {
    try
    {
        //some code
    }
    catch(Exception $e)
    {
        //exception code
    }
}

*/

class A{

	function onStart(swoole_server $server){

	/**
	 * 在此事件之前Swoole Server已进行了如下操作
		已创建了manager进程
		已创建了worker子进程
		已监听所有TCP/UDP端口
		已监听了定时器
		接下来要执行

		主Reactor开始接收事件，客户端可以connect到Server
		onStart回调中，仅允许echo、打印Log、修改进程名称。不得执行其他操作。onWorkerStart和onStart回调是在不同进程中并行执行的，不存在先后顺序。

		可以在onStart回调中，将$serv->master_pid和$serv->manager_pid的值保存到一个文件中。这样可以编写脚本，向这两个PID发送信号来实现关闭和重启的操作。

		从1.7.5+ Master进程内不再支持定时器，onMasterConnect/onMasterClose2个事件回调也彻底移除。Master进程内不再保留任何PHP的接口。
	 */


	}

	function onShutDown(swoole_server $server){
		// 此事件在Server结束时发生
		// 在此之前Swoole Server已进行了如下操作

		// 已关闭所有线程
		// 已关闭所有worker进程
		// 已close所有TCP/UDP监听端口
		// 已关闭主Rector
		// 强制kill进程不会回调onShutdown，如kill -9
		// 需要使用kill -15来发送SIGTREM信号到主进程才能按照正常的流程终止
	}
	/**
	 * [onWorkStart description]
	 * @param  swoole_server $server  [description]
	 * @param  int           $work_id [description]
	 * @return [type]                 [description]
	 */
	function onWorkStart(swoole_server $server ,int $work_id){
	/**
	 * swoole1.6.11之后task_worker中也会触发onWorkerStart
发生PHP致命错误或者代码中主动调用exit时，Worker/Task进程会退出，管理进程会重新创建新的进程
onWorkerStart/onStart是并发执行的，没有先后顺序
通过$worker_id参数的值来，判断worker是普通worker还是task_worker。$worker_id>= $serv->setting['worker_num'] 时表示这个进程是task_worker。

下面的示例用于为task_worker和worker进程重命名。

$serv->on('WorkerStart', function ($serv, $worker_id){
    global $argv;
    if($worker_id >= $serv->setting['worker_num']) {
        swoole_set_process_name("php {$argv[0]} task worker");
    } else {
        swoole_set_process_name("php {$argv[0]} event worker");
    }
});
如果想使用swoole_server_reload实现代码重载入，必须在workerStart中require你的业务文件，而不是在文件头部。在onWorkerStart调用之前已包含的文件，不会重新载入代码。

可以将公用的，不易变的php文件放置到onWorkerStart之前。这样虽然不能重载入代码，但所有worker是共享的，不需要额外的内存来保存这些数据。
onWorkerStart之后的代码每个worker都需要在内存中保存一份
$worker_id是一个从0-$worker_num之间的数字，表示这个worker进程的ID
$worker_id和进程PID没有任何关系
	 */

	}


	/**
	 * 此事件在worker进程终止时发生。在此函数中可以回收worker进程申请的各类资源。
	 * @param  swoole_server $server  [description]
	 * @param  int           $work_id [$worker_id是一个从0-$worker_num之间的数字，表示这个worker进程的ID]
	 */
	function onWorkstop(swoole_server $server ,int $work_id){

	}

	/**
	 * 定时器触发
	 * @param  swoole_server $server [description]
	 * @param  int           $intval [description]
	 * @return [type]                [description]
	 */
	function onTimer(swoole_server $server,int $intval){
		/**
		 * $interval是定时器时间间隔，根据$interval的值来区分是哪个定时器触发的。这里的定时器是由$serv->addtimer来添加的，是固定间隔循环触发的
		 *
		 * onTimer中执行时间过长，会导致下一次定时延缓触发。如设定1秒的定时器，1秒后会触发onTimer，onTimer函数用时1.5s，那么第二次触发onTimer的时间为第3秒。中间第2秒的定时器会被丢弃
onTimer回调函数如果要执行一个耗时操作，最好是使用$serv->task投递到task进程池中执行
		 */
	}

	/**
	 * 有新的连接进入时，在worker进程中回调 
	 * @param  swoole_server $server  [$server是swoole_server对象]
	 * @param  int           $fd      [$fd是连接的文件描述符，发送数据/关闭连接时需要此参数]
	 * @param  int           $from_id [$from_id来自那个Reactor线程]
	 * @return [type]                 [description]
	 */
	function onConnect(swoole_server $server,int $fd,int $from_id){
		/**
		 * onConnect/onClose这2个回调发生在worker进程内，而不是主进程。
			UDP协议下只有onReceive事件，没有onConnect/onClose事件

			回调函数中经常看到它。

			from_id是来自于哪个reactor线程
			fd是tcp连接的文件描述符，在swoole_server中是客户端的唯一标识符
			fd是复用的，当连接关闭后fd会被新进入的连接复用
			正在维持的TCP连接fd不会被复用
			调用swoole_server->send/swoole_server->close函数需要传入$fd参数才能被正确的处理。如果业务中需要发送广播，需要用apc/redis/memcache/swoole_table将fd的值保存起来。

			1.6.0以上版本不再需要from_id参数，swoole本身提供了ConnectionList可以查询到当前所有的fd和对应from_id
			1.7.10以上版本，fd不再是文件描述符。fd是一个自增数字，范围是 1 ～ 1600万
			fd超过1600万后会自动从1开始进行复用
			function my_onReceive($serv, $fd, $from_id, $data)  {
			    //向Connection发送数据
			    $serv->send($fd, 'Swoole: '.$data); 

			    //关闭Connection
			    $serv->close($fd); 
			}
			$fd为什么使用整形

			$fd 使用整形而不是使用对象，主要原因是swoole是多进程的模型，在Worker进程/Task进程中随时可能要访问某一个客户端连接，如果使用对象，那就需要进行Serialize/Unserialize。增加了额外的性能开销。$fd 如果是整数那就可以直接存储传输被使用。

			在PHP层可以也客户端连接可以封装成对象。面向对象的好处是可读性更好，对连接的操作可以封装到方法中。如

			$connection->send($data);
			$connection->close();
		 */
	}

	/**
	 * 接收到数据时回调此函数，发生在worker进程中。
	 * @param  swoole_server $server  [$server，swoole_server对象]
	 * @param  [type]        $fd      [$fd，TCP客户端连接的文件描述符]
	 * @param  [type]        $from_id [TCP连接所在的Reactor线程ID]
	 * @param  [type]        $data    [收到的数据内容，可能是文本或者二进制内容]
	 * 未开启swoole的自动协议选项，onReceive回调函数单次收到的数据最大为64K
Swoole支持二进制格式，$data可能是二进制数据
	 */
	function onReceive(swoole_server $server,$fd ,$from_id,$data){
		/**
		 * UDP协议，onReceive可以保证总是收到一个完整的包，最大长度不超过64K
UDP协议下，$fd参数是对应客户端的IP，$from_id是客户端的端口
TCP协议是流式的，onReceive无法保证数据包的完整性，可能会同时收到多个请求包，也可能只收到一个请求包的一部分数据
swoole只负责底层通信，$data是通过网络接收到的原始数据。对数据解包打包需要在PHP代码中自行实现
如果开启了eof_check/length_check/http_protocol，$data的长度可能会超过64K，但最大不超过$server->setting['package_max_length']
		 */
		

		/**
		 * 关于TCP协议下包完整性

使用swoole提供的open_eof_check/open_length_check/open_http_protocol，可以保证数据包的完整性
不使用swoole的协议处理，在onReceive后PHP代码中自行对数据分析，合并/拆分数据包。
例如：代码中可以增加一个 $buffer = array()，使用$fd作为key，来保存上下文数据。 每次收到数据进行字符串拼接，$buffer[$fd] .= $data，然后在判断$buffer[$fd]字符串是否为一个完整的数据包。

默认情况下，同一个fd会被分配到同一个worker中，所以数据可以拼接起来。使用dispatch_mode = 3时。
请求数据是抢占式的，同一个fd发来的数据可能会被分到不同的进程。所以无法使用上述的数据包拼接方法

关于粘包问题，如SMTP协议，客户端可能会同时发出2条指令。在swoole中可能是一次性收到的，这时应用层需要自行拆包。smtp是通过\r\n来分包的，所以业务代码中需要 explode("\r\n", $data)来拆分数据包。

如果是请求应答式的服务，无需考虑粘包问题。原因是客户端在发起一次请求后，必须等到服务器端返回当前请求的响应数据，才会发起第二次请求，不会同时发送2个请求。

		 */
	}

	/**
	 * 接收到UDP数据包时回调此函数，发生在worker进程中
	 * @param  swoole_server $server      [swoole_server对象]
	 * @param  string        $data        [收到的数据内容，可能是文本或者二进制内容]
	 * @param  array         $client_info [客户端信息包括address/port/server_socket 3项数据]
	 * @return [type]                     [description]
	 */
	function onPacket(swoole_server $server, string $data,array $client_info){
		/**
		 * 服务器同时监听TCP/UDP端口时，收到TCP协议的数据会回调onReceive，收到UDP数据包回调onPacket

onPacket事件回调在1.7.18以上版本可用
如果未设置onPacket回调函数，收到UDP数据包默认会回调onReceive函数
		 */
		
		/**
		 * onPacket回调可以通过计算得到onReceive的$fd和$reactor_id参数值。计算方法如下：

$fd = unpack('L', pack('N', ip2long($addr['address'])))[1];
$reactor_id = ($addr['server_socket'] << 16) + $addr['port'];
		 */
	}

	/**
	 * [onClose TCP客户端连接关闭后，在worker进程中回调此函数]
	 * @param  swoole_server $server  [$server是swoole_server对象]
	 * @param  int           $fd      [$fd是连接的文件描述符]
	 * @param  int           $from_id [来自那个reactor线程]
	 * @return [type]                 [description]
	 */
	function onClose(swoole_server $server,int $fd,int $from_id){
		/**
		 * onClose回调函数如果发生了致命错误，会导致连接泄漏。通过netstat命令会看到大量CLOSE_WAIT状态的TCP连接
无论由客户端发起close还是服务器端主动调用$serv->close()关闭连接，都会触发此事件。因此只要连接关闭，就一定会回调此函数
1.7.7+版本以后onClose中依然可以调用connection_info方法获取到连接信息，在onClose回调函数执行完毕后才会调用close关闭TCP连接
注意：这里回调onClose时表示客户端连接已经关闭，所以无需执行$server->close($fd)。代码中执行$serv->close($fd)会抛出PHP错误告警。
		 */
	}
	/**
	 * 在task_worker进程内被调用。worker进程可以使用swoole_server_task函数向task_worker进程投递新的任务。当前的Task进程在调用onTask回调函数时会将进程状态切换为忙碌，这时将不再接收新的Task，当onTask函数返回时会将进程状态切换为空闲然后继续接收新的Task。
	 * @param  swoole_server $server      [description]
	 * @param  int           $task_id     [$task_id是任务ID，由swoole扩展内自动生成，用于区分不同的任务。$task_id和$src_worker_id组合起来才是全局唯一的，不同的worker进程投递的任务ID可能会有相同]
	 * @param  int           $src_work_id [来自于哪个worker进程]
	 * @param  string        $data        [$data 是任务的内容]
	 * @return [type]                     [description]
	 */
	function onTask(swoole_server $server,int $task_id,int $src_work_id,string $data){
		/**
		 * 1.7.2以上的版本，在onTask函数中 return字符串，表示将此内容返回给worker进程。worker进程中会触发onFinish函数，表示投递的task已完成。

return的变量可以是任意非null的PHP变量
1.7.2以前的版本，需要调用swoole_server->finish()函数将结果返回给worker进程
		 */
	}

	/**
	 * 当worker进程投递的任务在task_worker中完成时，task进程会通过swoole_server->finish()方法将任务处理的结果发送给worker进程
	 * @param  swoole_server $server  [description]
	 * @param  int           $task_id [task_id是任务的ID]
	 * @param  string        $data    [$data是任务处理的结果内容]
	 * @return [type]                 [description]
	 */
	function onFinish(swoole_server $server,int$task_id,string $data){
		/**
		 * task进程的onTask事件中没有调用finish方法或者return结果。worker进程不会触发onFinish
		 */
	}

	/**
	 * 当工作进程收到由sendMessage发送的管道消息时会触发onPipeMessage事件。worker/task进程都可能会触发onPipeMessage事件
	 * @param  swoole_server $server       [description]
	 * @param  int           $from_work_id [description]
	 * @param  sring         $message      [description]
	 * @return [type]                      [description]
	 */
	function onPipeMessage(swoole_server $server,int $from_work_id,sring $message){
		/**
		 * onPipeMessage在swoole-1.7.9以上版本可用
		 */
	}

	/**
	 * [onWorkerError description]
	 * @param  swoole_server $server     [description]
	 * @param  int           $work_id    [$worker_id是异常进程的编号]
	 * @param  int           $worker_pid [worker_pid是异常进程的ID]
	 * @param  int           $exit_code  [exit_code退出的状态码，范围是 1 ～255]
	 * @return [type]                    [description]
	 */
	function onWorkerError(swoole_server $server,int $work_id,int $worker_pid,int $exit_code){
		/**
		 * 此函数主要用于报警和监控，一旦发现Worker进程异常退出，那么很有可能是遇到了致命错误或者进程CoreDump。通过记录日志或者发送报警的信息来提示开发者进行相应的处理。
		 */
	}

	/**
	 * 当管理进程启动时调用它，函数原型：
	 */
	function onManagerStart(swoole_server $server,){
		/**
		 * 在这个回调函数中可以修改管理进程的名称。

注意manager进程中不能添加定时器
manager进程中可以调用task功能
		 */
	}
	/**
	 * 当管理进程结束时调用它，函数原型：
	 * @param  swoole_server $server [description]
	 * @return [type]                [description]
	 */
	function onManagerStop(swoole_server $server){

	}
	
}

?>