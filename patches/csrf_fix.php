<?php
session_start();
function csrf_token(){
    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token']=bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
function csrf_input_field(){
    $t=htmlspecialchars(csrf_token(),ENT_QUOTES,'UTF-8');
    return '<input type="hidden" name="csrf_token" value="'.$t.'">';
}
function validate_csrf(){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $t=$_POST['csrf_token']??'';
        if(!hash_equals($_SESSION['csrf_token']??'',$t)){
            http_response_code(403);
            die('CSRF error');
        }
    }
}
