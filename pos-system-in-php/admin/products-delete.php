<?php
require "../config/function.php";
$id=$_GET['id'];

    $conn = mysqli_connect("localhost", "root", "", "pos_system_php");
    $paraResultId = checkParamId('id');
    $productId = validate($paraResultId);
    $product = getById('products', $productId);
    $queryDelete = "Delete FROM products WHERE id=$id";
    if(!(($result=mysqli_query($conn,$queryDelete))))
    {
        Echo "Not possible to delete product";
    }
    if($result){
        $deleteImage = "../".$product['data']['image'];
        if(file_exists($deleteImage))
        {
            unlink($deleteImage);
        }
        redirect("products.php","Product Deleted Successfully!.");
    }


