<?php
require_once "db.php";
$db = new Dbase();

if(isset($_POST['code'])){
    $code = $_POST['code'];

    $u_c = $db->sql("DELETE FROM `orders` WHERE product_code = '$code'");
    $sql = $db->sql("DELETE FROM `products` WHERE Code = '$code'");
    exit;
}

elseif(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = $db->query("SELECT * FROM users WHERE id = $id");

    foreach($sql as $key => $value){
        $login = $sql[$key]['Login'];
    }

    $u_r = $db->sql("DELETE FROM `user_roles` WHERE user_mail = '$login'");
    $u_c = $db->sql("DELETE FROM `orders` WHERE user_mail = '$login'");
    $user = $db->sql("DELETE FROM `users` WHERE id = '$id'");

    exit;
}
exit;
?>