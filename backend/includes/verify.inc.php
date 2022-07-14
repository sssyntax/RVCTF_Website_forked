<?php
function verify_account($conn,$email,$password){
    $sql = "SELECT `password` FROM `users` WHERE `email` = ?";
    $result = prepared_query($conn,$sql,[$email],"s");
    $result -> bind_result($encrypted);
    $result -> fetch();
    return password_verify($password,$encrypted);
}
?>