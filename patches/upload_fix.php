<?php
session_start();
$UPLOAD_DIR=__DIR__.'/../safe_uploads/';
if(!is_dir($UPLOAD_DIR)) mkdir($UPLOAD_DIR,0700,true);
$ALLOWED_EXT=['jpg','jpeg','png','gif','pdf'];
$ALLOWED_MIMES=['image/jpeg','image/png','image/gif','application/pdf'];
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_FILES['upload'])){
    $f=$_FILES['upload'];
    if($f['error']!==0) die('error');
    if($f['size']>5*1024*1024) die('size');
    $mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
    if(!in_array($mime,$ALLOWED_MIMES)) die('type');
    $ext=strtolower(pathinfo($f['name'],PATHINFO_EXTENSION));
    if(!in_array($ext,$ALLOWED_EXT)) die('ext');
    $name=bin2hex(random_bytes(16)).'.'.$ext;
    $dest=$UPLOAD_DIR.$name;
    if(!move_uploaded_file($f['tmp_name'],$dest)) die('fail');
    echo htmlspecialchars($name,ENT_QUOTES,'UTF-8');
}
