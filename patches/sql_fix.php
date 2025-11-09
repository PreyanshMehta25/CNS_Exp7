<?php
$dsn="mysql:host=127.0.0.1;dbname=dvwa;charset=utf8mb4";
$db_user="dvwa_user";
$db_pass="CHANGE_ME";
$pdo=new PDO($dsn,$db_user,$db_pass,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false]);
function check_login(PDO $pdo,string $username,string $password):bool{
    $sql="SELECT password_hash FROM users WHERE username=:username LIMIT 1";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([':username'=>$username]);
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if(!$row) return false;
    return password_verify($password,$row['password_hash']);
}
