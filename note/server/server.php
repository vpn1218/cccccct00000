<?php


$serv = new swoole_server('0.0.0.0',9501);

$serv->on("connent",function($serv,$fd){
    echo "connected \n";
});

$serv->on("receive",function($serv,$fd,$from_id,$data){
    $serv->send($fd,'Server:'.$data);
});

$serv->on("close",function($serv,$fd){
    echo "Client:close\n";
});

$serv->start();