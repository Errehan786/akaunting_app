<?php
include_once('component/app-main.php');
error_reporting(0);
$obj = new Database();
$sender_id = $_POST["sender_id"];
$receiver_id = $_POST["receiver_id"];
$amount = $_POST["amount"];
$paid = $_POST["paid"];

if(isset($sender_id) && isset($receiver_id) && isset($amount)){
    $value = ["sender_id"=>$sender_id,"receiver_id"=>$receiver_id,"amount"=>$amount];
    if($obj->insert("invoices",$value)){
    $MSG = 'invoice Created Successfully';
    $json = json_encode($MSG);
    // Echo the message.
    echo $json ;
}else{
 echo json_encode('Try Again');
 }
} elseif(isset($paid)){
    $value = ["paid"=>$paid];
	if($obj->update("invoices",$value,"id='$_POST[invoice_id]'")){
        $MSG = 'invoice Updated Successfully';
        $json = json_encode($MSG);
        // Echo the message.
        echo $json ;
    }else{
        echo json_encode('Try Again');
    }
}
?>
