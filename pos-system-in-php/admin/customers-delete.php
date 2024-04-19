<?php
require "../config/function.php";
$id=$_GET['id'];

    $conn = mysqli_connect("localhost", "root", "", "pos_system_php");

    $queryDelete = "Delete FROM customers WHERE id=$id";
    if(!(($result=mysqli_query($conn,$queryDelete))))
    {
        Echo "Not possible to delete data";
    }
    if($result){
            redirect("customers.php","customer Deleted Successfully!.");
    }
