<?php
include_once('component/app-main.php');
$obj = new Database();
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($username) && isset($email) && isset($password)){
    $value = ["username"=>$username,"email"=>$email,"password"=>$password];
    if($obj->insert("user_tbl",$value)){
    $MSG = 'User Created Successfully';
    $json = json_encode($MSG);
    // Echo the message.
    echo $json ;
}else{
 echo json_encode('Try Again');
 }
} 
?>