<?php
session_start();
$limit=5;
$window=300;
$key='login_attempts';
if(!isset($_SESSION[$key])) $_SESSION[$key]=[];
$now=time();
$_SESSION[$key]=array_filter($_SESSION[$key],fn($t)=>($now-$t)<$window);
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(count($_SESSION[$key])>=$limit){
        http_response_code(429);
        die('Too many attempts');
    }
    $success=false;
    if(!$success){
        $_SESSION[$key][]=$now;
    } else {
        $_SESSION[$key]=[];
    }
}
