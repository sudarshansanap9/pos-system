<?php

include("..\config/function.php");
?>
<?php
global $conn;
$conn = mysqli_connect("localhost", "root", "", "pos_system_php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST["saveAdmin"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $is_ban = isset($_POST["is_ban"]) == true ? 1:0;

    if($name != "" && $email != "" && $password != ""){
        
        $emailCheck = mysqli_query($conn,"SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect("admins-create.php","Email Already used by another user.");
            }
    }
    
    $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

    $data = [
        'name' => $name,
        'email'=> $email,
        'password'=> $bcrypt_password,
        'phone'=> $phone,
        'is_ban'=> $is_ban	
    ];
    $result = insert('admins', $data);
    if($result){
        redirect("admins.php","Admin Created Successfully!.");
    }else{
        redirect("admins-create.php","Something Went Wrong!.");
    }
    
    }else{
        redirect("admins-create.php","Please field required fields.");
    }
}
if(isset($_POST["updateAdmin"]))
{
    $adminId = validate($_POST['adminId']);

    $adminData = getById('admins',$adminId);
    if($adminData['status'] != 200){
        redirect("admin-edit.php?id=".$adminId,"Please field required fields.");
    }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    $is_ban = isset($_POST["is_ban"]) == true ? 1:0;

    if($password !=''){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword = $adminData['data']['password'];
    }

    if($name != "" && $email != "" )
    {
        $data = [
            'name' => $name,
            'email'=> $email,
            'password'=> $hashedPassword,
            'phone'=> $phone,
            'is_ban'=> $is_ban	
        ];
        $result = update('admins', $adminId, $data);
        if($result){
            redirect("admin-edit.php?id=".$adminId,"Admin updated Successfully!.");
        }else{
            redirect("admin-edit.php?id=".$adminId,"Something Went Wrong!");
        }
    }
    else{
        redirect("admins-create.php","Please field required fields.");
    }
}
?>