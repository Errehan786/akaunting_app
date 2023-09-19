<?php
include_once('component/app-main.php');
$obj = new Database();
$sender_id = $_POST["sender_id"];
$receiver_id = $_POST["receiver_id"];
$amount = $_POST["amount"];

if(isset($sender_id) && isset($receiver_id) && isset($amount)){
    $value = ["sender_id"=>$sender_id,"receiver_id"=>$receiver_id,"amount"=>$amount];
    if($obj->insert("transactions",$value)){
    $MSG = 'transactions Created Successfully';
    $json = json_encode($MSG);
    // Echo the message.
    echo $json ;
}else{
 echo json_encode('Try Again');
 }
} 
?>