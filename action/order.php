<?php
if(isset($_POST['code'])){
    require_once "action/db.php";
    $db = new Dbase();

    $code = $_POST['code'];
    $user_mail = $_SESSION['mail'];

    $sql = $db->sql("INSERT INTO `orders`(`id`, `user_mail`, `product_code`, `number`, `date`, `time`) VALUES ('','$user_mail','$code',1, CURRENT_DATE(), CURRENT_TIME())");

    
}
?>