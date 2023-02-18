<?php
include ('config/db_config.php');
$payment_id = $_GET['payment_id'];
$gifts = $_GET['gift'];

$insert_data = $con->query("INSERT INTO `gifts`(`gifts`, `txn_id`) VALUES ('$gifts','$payment_id')");

if($insert_data){
    header('Location: address.php?payment_id='.$payment_id);
}else{
    echo "Something went wrong";
}
