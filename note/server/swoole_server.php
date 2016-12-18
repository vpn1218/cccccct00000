<?php
class swoole_server{
    /**
     * 构造函数
     * @param [type] $host      [监听的ip]
     * @param [type] $port      [监听的端口]
     * @param [type] $mode      [运行模式] 3种模式 默认多进程模式
     * @param [type] $sock_type [指定socket的类型，支持TCP/UDP、TCP6/UDP6、UnixSock Stream/Dgram]
     */
    public function __construct($host,$port,$mode,$sock_type) {
        
    }
    /**
     * 监听一个新的Server端口，此方法是addlistener的别名。listen方法在swoole-1.7.9以上版本可用
     * @param  [type] $host      [description]
     * @param  [type] $port      [description]
     * @param  [type] $sock_type [description]
     * @return [type]            [description]
     */
    public function listen($host,$port,$sock_type){

    }
    /**
     * Swoole提供了swoole_server::addListener来增加监听的端口。业务代码中可以通过调用swoole_server::connection_info来获取某个连接来自于哪个端口。
     * @param  [type] $host      [description]
     * @param  [type] $port      [description]
     * @param  [type] $sock_type [description]
     * @return [type]            [description]
     */
    public function addlisten($host,$port,$sock_type){
        /**
         * swoole支持的Socket类型

SWOOLE_TCP/SWOOLE_SOCK_TCP tcp ipv4 socket
SWOOLE_TCP6/SWOOLE_SOCK_TCP6 tcp ipv6 socket
SWOOLE_UDP/SWOOLE_SOCK_UDP udp ipv4 socket
SWOOLE_UDP6/SWOOLE_SOCK_UDP6 udp ipv6 socket
SWOOLE_UNIX_DGRAM unix socket dgram
SWOOLE_UNIX_STREAM unix socket stream
Unix Socket仅在1.7.1+后可用，此模式下$host参数必须填写可访问的文件路径，$port参数忽略
Unix Socket模式下，客户端$fd将不再是数字，而是一个文件路径的字符串
SWOOLE_TCP等是1.7.0+后提供的简写方式，与1.7.0前的SWOOLE_SOCK_TCP是等同的
         */
    }
    /**
     * 注册Server的事件回调函数。
     * @param  [type] $name     [回调的名称,大小写不敏感，具体内容参考回调函数列表，事件名称字符串不要加on]
     * @param  [type] $callback [回调的PHP函数，可以是函数名的字符串，类静态方法，对象方法数组，匿名函数。]
     */
    public function on($name,$callback){

        
        require 'callback.php';




    }
    /**
     * 用于设置swoole_server运行时的各项参数
     * @param [type] $zset [description]
     */
    public function set($zset){
            $zset = [
            // 最大允许维持多少个tcp连接 超过最大值，将拒绝新连接
                max_conn => 10000, 
                // 开启守护进程
                daemonize => 1,
                // 通过此参数来调节poll线程的数量，以充分利用多核
                reactor_num => 2,
                // 设置启动的worker进程数量
                worker_num => 4,
                // 此参数表示worker进程在处理完n次请求后结束运行,设置为0表示不自动重启
                max_request => 2000,
                //此参数将决定最多同时有多少个待accept的连接
                backlog => 128,
                // 启用CPU亲和设置
                open_cpu_affinity => 1,
                // 启用tcp_nodelay
                open_tcp_nodelay => 1,
                // 此参数设定一个秒数，当客户端连接连接到服务器时，在约定秒数内并不会触发accept，直到有数据发送，或者超时时才会触发。
                tcp_defer_accept => 5,
                // 指定swoole错误日志文件。
                log_file => '/data/log/swoole.log',
                // 打开buffer
                open_eof_check => true,
                // 每隔多少秒检测一次，单位秒，Swoole会轮询所有TCP连接，将超过心跳时间的连接关闭掉
                heartbeat_check_interval => 30 ,
                // TCP连接的最大闲置时间，单位s , 如果某fd最后一次发包距离现在的时间超过
                heartbeat_idle_time => 60,
                // 会把这个连接关闭。
                heartbeat_idle_time,
                // 1平均分配，2按FD取摸固定分配，3抢占式分配，默认为取模(dispatch=2)
                dispatch_mode = 1 
            ];
    }
    /**
     * 启动server，监听所有TCP/UDP端口，启动成功后会创建worker_num+2个进程。主进程+Manager进程+worker_num个Worker进程。启用task_worker会增加相应数量的子进程
函数列表中start之前的方法仅可在start调用前使用，在start之后的方法仅可在start调用后使用
     * @return [type] [description]
     */
    public function start(){
        /**
         * 主进程

主进程内有多个Reactor线程，基于epoll/kqueue进行网络事件轮询。收到数据后转发到worker进程去处理

Manager进程

对所有worker进程进行管理，worker进程生命周期结束或者发生异常时自动回收，并创建新的worker进程

worker进程

对收到的数据进行处理，包括协议解析和响应请求。

启动失败扩展内会抛出致命错误，请检查php error_log的相关信息。errno={number}是标准的Linux Errno，可参考相关文档。
如果开启了log_file设置，信息会打印到指定的Log文件中。
         */
        

        /**
         * bind端口失败,原因是其他进程已占用了此端口
未设置必选回调函数，启动失败
php有代码致命错误，请检查php的错误信息php_err.log
执行ulimit -c unlimited，打开core dump，查看是否有段错误
关闭daemonize，关闭log，使错误信息可以打印到屏幕
         */

    }
    /**
     * 向客户端发送数据,发送成功会返回true
发送失败会返回false，调用$server->getLastError()方法可以得到失败的错误码

     * send操作具有原子性，多个进程同时调用send向同一个连接发送数据，不会发生数据混杂
如果要发送超过2M的数据，可以将数据写入临时文件，然后通过sendfile接口进行发送
通过设置buffer_output_size参数可以修改发送长度的限制

     * UDP服务器

send操作会直接在worker进程内发送数据包，不会再经过主进程转发
使用fd保存客户端IP，from_id保存from_fd和port
如果在onReceive后立即向客户端发送数据，可以不传$from_id
如果向其他UDP客户端发送数据，必须要传入from_id
在外网服务中发送超过64K的数据会分成多个传输单元进行发送，如果其中一个单元丢包，会导致整个包被丢弃。所以外网服务，建议发送1.5K以下的数据包

     * @param  [type] $fd         [description]
     * @param  [type] $send_data  [发送的数据。TCP协议最大不得超过2M，UDP协议不得超过64K]
     * @param  [type] $reactor_id [description]
     * @return [type]             [description]
     */
    public function send($fd,$send_data,$reactor_id){

    }
    /**
     * 向任意的客户端IP:PORT发送UDP数据包。
     * @param  [type] $ip        [为IPv4字符串，如192.168.1.102。如果IP不合法会返回错误]
     * @param  [type] $port      [为 1-65535的网络端口号，如果端口错误发送会失败]
     * @param  [type] $send_data [要发送的数据内容，可以是文本或者二进制内容]
     * @param  $server_socket 服务器可能会同时监听多个UDP端口，此参数可以指定使用哪个端口发送数据包
     * @return swoole_server->sendto 在1.7.10+版本可用
server必须监听了UDP的端口，才可以使用swoole_server->sendto
server必须监听了UDP6的端口，才可以使用swoole_server->sendto向IPv6地址发送数据
     */
    public function sendto($ip,$port,$send_data, int $server_socket = -1){

    }
    /**
     * 有一些特殊的场景，Server需要连续向客户端发送数据，而swoole_server->send数据发送接口是纯异步的，大量数据发送会导致内存发送队列塞满。

使用swoole_server->sendwait就可以解决此问题，swoole_server->sendwait会阻塞等待连接可写。直到数据发送完毕才会返回。
     * @param  [type] $conn_fd   [description]
     * @param  [type] $send_data [description]
     * sendwait目前仅可用于SWOOLE_BASE模式
     */
    public function sendwait($conn_fd,$send_data){

    }

    public function exit($fd){

    }

    public function protect($fd,$is_protected){

    }
    /**
     * sendfile函数调用OS提供的sendfile系统调用，由操作系统直接读取文件并写入socket。sendfile只有2次内存拷贝，使用此函数可以降低发送大量文件时操作系统的CPU和内存占用。
     * @param  [type] $conn_fd  [description]
     * @param  [type] $filename [要发送的文件路径，如果文件不存在会返回false]
     */
    public function sendfile($conn_fd,$filename){

    }
    /**
     * 关闭客户端连接，函数原型：操作成功返回true，失败返回false.
Server主动close连接，也一样会触发onClose事件。
不要在close之后写清理逻辑。应当放置到onClose回调中处理
$reset设置为true会强制关闭连接，丢弃发送队列中的数据
     * @param  [type] $fd [description]
     * @return [type]     [description]
     */
    public function close($fd){

    }

    public function confirm($fd){

    }
    /**
     * 停止接收数据。调用此函数后会将连接从EventLoop中移除，不再接收客户端数据。
此函数不影响发送队列的处理  pause方法仅可用于BASE模式
     * @param  [type] $fd [description]
     * @return [type]     [description]
     */
    public function pause($fd){

    }
    /**
     * 恢复数据接收。与pause方法成对使用 调用此函数后会将连接重新加入到EventLoop中，继续接收客户端数据
     * @param  [type] $fd [description]
     * resume方法仅可用于BASE模式
     */
    public function resume($fd){

    }

    public function task($data,$work_id){

    }

    public function taskwait($data,$timeout,$work_id){

    }

    public function taskWaitMulti($tasks,$timeout){

    }
    /**
     * 此函数用于在task进程中通知worker进程，投递的任务已完成。此函数可以传递结果数据给worker进程。
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function finish($data){

    }
    /**
     * 重启所有worker进程。
     * @param  boolean $only_reload_taskworkrer [only_reload_taskworkrer 是否仅重启task进程]
     * @return [type]                           [description]
     */
    public function reload($only_reload_taskworkrer = false){
        /**
         * 一台繁忙的后端服务器随时都在处理请求，如果管理员通过kill进程方式来终止/重启服务器程序，可能导致刚好代码执行到一半终止。

这种情况下会产生数据的不一致。如交易系统中，支付逻辑的下一段是发货，假设在支付逻辑之后进程被终止了。会导致用户支付了货币，但并没有发货，后果非常严重。

Swoole提供了柔性终止/重启的机制，管理员只需要向SwooleServer发送特定的信号，Server的worker进程可以安全的结束。

SIGTERM: 向主进程发送此信号服务器将安全终止
在PHP代码中可以调用$serv->shutdown()完成此操作
SIGUSR1: 向管理进程发送SIGUSR1信号，将平稳地restart所有worker进程
在PHP代码中可以调用$serv->reload()完成此操作
swoole的reload有保护机制，当一次reload正在进行时，收到新的重启信号会丢弃
如果设置了user/group，Worker进程可能没有权限向master进程发送信息，这种情况下必须使用root账户，在shell中执行kill指令进行重启
#重启所有worker进程
kill -USR1 主进程PID
1.7.7版本增加了仅重启task_worker的功能。只需向服务器发送SIGUSR2即可。

#仅重启task进程
kill -USR2 主进程PID
平滑重启只对onWorkerStart或onReceive等在Worker进程中include/require的PHP文件有效，Server启动前就已经include/require的PHP文件，不能通过平滑重启重新加载
对于Server的配置即$serv->set()中传入的参数设置，必须关闭/重启整个Server才可以重新加载
Server可以监听一个内网端口，然后可以接收远程的控制命令，去重启所有worker
Reload有效范围

Reload操作只能重新载入Worker进程启动后加载的PHP文件，建议使用get_included_files函数来列出哪些文件是在WorkerStart之前就加载的PHP文件，在此列表中的PHP文件，即使进行了reload操作也无法重新载入。比如要关闭服务器重新启动才能生效。

$serv->on('WorkerStart', function($serv, $workerId) {
    var_dump(get_included_files()); //此数组中的文件表示进程启动前就加载了，所以无法reload
});
APC/OpCache

如果PHP开启了APC/OpCache，reload重载入时会受到影响，有2种解决方案

打开APC/OpCache的stat检测，如果发现文件更新APC/OpCache会自动更新OpCode
在onWorkerStart中执行apc_clear_cache或opcache_reset刷新OpCode缓存
         */
    }

    /**
     * 使当前worker进程停止运行，并立即触发onWorkerStop回调函数。
     * 使用此函数代替exit/die结束Worker进程的生命周期
如果要结束其他Worker进程，可以在stop里面加上worker_id作为参数或者使用swoole_process::kill($worker_pid)
此方法在1.8.2或更高版本可用
     * @return [type] [description]
     */
    public function stop(){}

    /**
     * 关闭服务器
     * 此函数可以用在worker进程内。向主进程发送SIGTERM也可以实现关闭服务器。

kill -15 主进程PID
     */
    public function shutdown(){

    }
    /**
     * 获取最近一次操作错误的错误码。业务代码中可以根据错误码类型执行不同的逻辑。
     * 1001 连接已经被Server端关闭了，出现这个错误一般是代码中已经执行了$serv->close()关闭了某个连接，但仍然调用$serv->send()向这个连接发送数据
1002 连接已被Client端关闭了，Socket已关闭无法发送数据到对端
1003 正在执行close，onClose回调函数中不得使用$serv->send()
1004 连接已关闭
1005 连接不存在，传入$fd 可能是错误的
1008 发送缓存区已满无法执行send操作，出现这个错误表示这个连接的对端无法及时收数据导致发送缓存区已塞满
     */
    public function getLastError(){}
    /**
     * 检测服务器所有连接，并找出已经超过约定时间的连接。如果指定if_close_connection，则自动关闭超时的连接。未指定仅返回连接的fd数组。
     * @param  [type] $reactor_id [description]
     * $if_close_connection是否关闭超时的连接，默认为true
调用成功将返回一个连续数组，元素是已关闭的$fd。
调用失败返回false
     */
    public function heartbeat($reactor_id){

    }
    /**
     * 函数用来获取连接的信息
     * @param  [type]       $fd           [description]
     * @param  [type]       $reactor_id   [description]
     * @param  bool|boolean $ignore_close [description]
     * @return [type]                     [description]
     *需要swoole-1.5.8以上版本
connect_time, last_time 在v1.6.10+可用
connection_info可用于UDP服务器，但需要传入from_id参数
     *
     *
     * from_id 来自哪个reactor线程
server_fd 来自哪个server socket 这里不是客户端连接的fd
server_port 来自哪个Server端口
remote_port 客户端连接的端口
remote_ip 客户端连接的ip
connect_time 连接到Server的时间，单位秒
last_time 最后一次发送数据的时间，单位秒
     */
    public function connection_info($fd,$reactor_id,bool $ignore_close = false){

    }
    /**
     * 用来遍历当前Server所有的客户端连接，connection_list方法是基于共享内存的，不存在IOWait，遍历的速度很快。另外connection_list会返回所有TCP连接，而不仅仅是当前worker进程的TCP连接。
     * @param  [type] $start_fd   [description]
     * @param  [type] $find_count [description]
     * 此函数接受2个参数，第1个参数是起始fd，第2个参数是每页取多少条，最大不得超过100.

调用成功将返回一个数字索引数组，元素是取到的$fd。数组会按从小到大排序。最后一个$fd作为新的start_fd再次尝试获取
调用失败返回false
     */
    public function connection_list($start_fd,$find_count){

    }

    public function getClientInfo($fd,$reactor_id){

    }

    public function getClientList($start_fd,$find_count){

    }
    /**
     * 在指定的时间后执行函数，需要swoole-1.7.7以上版本
     * swoole_server::after函数是一个一次性定时器，执行完成后就会销毁。
     * @param  [type] $ms       [ 指定时间，单位为毫秒]
     * @param  [type] $callback [时间到期后所执行的函数，必须是可以调用的。callback函数不接受任何参数]
     * @param  [type] $param    [description]
     * 低于1.8.0版本task进程不支持after定时器，仅支持addtimer定时器
     */
    public function after($ms,$callback,$param){

    }
    /**
     * tick定时器，可以自定义回调函数。此函数是swoole_timer_tick的别名。
     * worker进程结束运行后，所有定时器都会自动销毁
tick/after定时器不能在swoole_server->start之前使用
     * @param  [type] $ms       [description]
     * @param  [type] $callback [description]
     * @return [type]           [description]
     */
    public function tick($ms,$callback){

    }
    /**
     * 清除tick/after定时器，此函数是swoole_timer_clear的别名。
     * @param  [type] $time_id [description]
     * @return [type]          [description]
     */
    public function clearTimer($time_id){

    }
    /**
     * 延后执行一个PHP函数。Swoole底层会在EventLoop循环完成后执行此函数。此函数的目的是为了让一些PHP代码延后执行，程序优先处理IO事件。defer函数的别名是swoole_event_defer
     * @param  [type] $callback [$callback为可执行的函数变量，可以是字符串、数组、匿名函数]
     * @return [type]           [description]
     */
    public function defer($callback){

    }
    /**
     * 此函数可以向任意worker进程或者task进程发送消息。在非主进程和管理进程中可调用。收到消息的进程会触发onPipeMessage事件。
     * $message为发送的消息数据内容，没有长度限制，但超过8K时会启动内存临时文件
     * $dst_worker_id为目标进程的ID，范围是0 ~ (worker_num + task_worker_num - 1)
     *
     * 在Task进程内调用sendMessage是阻塞等待的，发送消息完成后返回
在Worker进程内调用sendMessage是异步的，消息会先存到发送队列，可写时向管道发送此消息
在User进程内调用sendMessage底层会自动判断当前的进程是异步还是同步选择不同的发送方式
sendMessage接口在swoole-1.7.9以上版本可用
MacOS/FreeBSD下超过2K就会使用临时文件存储
使用sendMessage必须注册onPipeMessage事件回调函数
     */
    public function sendMessage(string $message, int $dst_worker_id){

    }
    /**
     * 添加一个用户自定义的工作进程。
     * @param swoole_process $process [description]
     */
    public function addProcess(swoole_process $process){
        /**
         * $process 为swoole_process对象，注意不需要执行start。在swoole_server启动时会自动创建进程，并执行指定的子进程函数
创建的子进程可以调用$server对象提供的各个方法，如connection_list/connection_info/stats
在worker/task进程中可以调用$process提供的方法与子进程进行通信
在用户自定义进程中可以调用$server->sendMessage与worker/task进程通信
此函数通常用于创建一个特殊的工作进程，用于监控、上报或者其他特殊的任务。

子进程会托管到Manager进程，如果发生致命错误，manager进程会重新创建一个
子进程内不能使用swoole_server->task/taskwait接口
此函数在swoole-1.7.9以上版本可用
         */
    }
    /**
     * 得到当前Server的活动TCP连接数，启动时间，accpet/close的总次数等信息
     * array swoole_server->stats();
返回的结果数组示例：

array (
  'start_time' => 1409831644,
  'connection_num' => 1,
  'accept_count' => 1,
  'close_count' => 0,
);
start_time 服务器启动的时间
connection_num 当前连接的数量
accept_count 接受了多少个连接
close_count 关闭的连接数量
tasking_num 当前正在排队的任务数
stats()方法在1.7.5+后可用
请求数量

request_count => 1000, Server收到的请求次数
worker_request_count => 当前Worker进程收到的请求次数
消息队列状态

swoole-1.8.5版本增加了Task消息队列的统计数据。

array (
  'task_queue_num' => 10,
  'task_queue_bytes' => 65536,
);
task_queue_num 消息队列中的Task数量
task_queue_bytes 消息队列的内存占用字节数
     */
    public function stats(){}
    /**
     * 调用此方法可以得到底层的socket句柄，返回的对象为sockets资源句柄。

此方法需要依赖PHP的sockets扩展，并且编译swoole时需要开启--enable-sockets选项
     * @return [type] [description]
     */
    public function getSocket(){}

    /**
     * 将连接绑定一个用户定义的ID，可以设置dispatch_mode=5设置已此ID值进行hash固定分配。可以保证某一个UID的连接全部会分配到同一个Worker进程。

在默认的dispatch_mode=2设置下，server会按照socket fd来分配连接数据到不同的worker。因为fd是不稳定的，一个客户端断开后重新连接，fd会发生改变。这样这个客户端的数据就会被分配到别的Worker。使用bind之后就可以按照用户定义的ID进行分配。即使断线重连，相同uid的TCP连接数据会被分配相同的Worker进程。
     * @param  [type] $fd  [description]
     * @param  [type] $uid [description]
     * 同一个连接只能被bind一次，如果已经绑定了uid，再次调用bind会返回false
可以使用$serv->connection_info($fd) 查看连接所绑定uid的值
     */
    public function bind($fd,$uid){

    }

    /**
     * 检测fd对应的连接是否存在。
     * @param  int    $fd [$fd对应的TCP连接存在返回true，不存在返回false]
     * 此接口是基于共享内存计算，没有任何IO操作
swoole_server->exist在1.7.18以上版本可用
     */
    public function exist(int $fd){

    }


?>