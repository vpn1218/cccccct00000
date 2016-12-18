<?php
class swoole_http_server extends swoole_server{

    private $global;

    public function on($ha_name,$cb){

    }

    public function start(){

    }

    public function __construct($host,$port,$mode,$sock_type ) {
       
    }


    public function listen($host,$port,$sock_type){

    }

    public function addlisten($host,$port,$sock_type){

    }

    public function set($zset){

    }


    public function send($fd,$send_data,$reactor_id){

    }

    public function sendto($ip,$port,$send_data){

    }

    public function sendwait($conn_fd,$send_data){

    }

    public function exist($fd){

    }

    public function protect($fd,$is_protected){

    }

    public function sendfile($conn_fd,$filename){

    }

    public function close($fd){

    }

    public function confirm($fd){

    }

    public function pause($fd){

    }

    public function resume($fd){

    }

    public function task($data,$work_id){

    }

    public function taskwait($data,$timeout,$work_id){

    }

    public function taskWaitMulti($tasks,$timeout){

    }

    public function finish($data){

    }

    public function reload(){}
    public function shutdown(){}
    public function stop(){}
    public function getLastError(){}

    public function heartbeat($reactor_id){

    }

    public function connection_info($fd,$reactor_id){

    }

    public function connection_list($start_fd,$find_count){

    }

    public function getClientInfo($fd,$reactor_id){

    }

    public function getClientList($start_fd,$find_count){

    }

    public function after($ms,$callback,$param){

    }

    public function tick($ms,$callback){

    }

    public function clearTimer($time_id){

    }

    public function defer($callback){

    }

    public function sendMessage(){}
    public function addProcess(){}
    public function stats(){}
    public function getSocket(){}


    public function bind($fd,$uid){
        
    }



}





?>