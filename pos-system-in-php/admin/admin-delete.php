<?php


require '../admin/admins.php';
$amey = 'id';
// $paraResultId = checkParamId('id');
if(is_numeric($amey)){

    $adminId = validate($amey);
    echo $adminId;
}else{
    redirect('admins.php','Something Went Wrong');
}
