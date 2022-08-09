<?php
session_start();
require "includes/connect.inc.php";
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirmpassword"];
$errorlst = array();
if ($password != $confirm){
    array_push($errorlst,"matchingerror");
}
$sql = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
if ($count >= 1){
    array_push($errorlst,"inuseerror");
}
if (count($errorlst)!=0){
    header("Location: ../index.php?filename=signup&error=".json_encode($errorlst));
}
else{
    $sql = "INSERT INTO `users`(`email`,`password`) VALUES (?,?)";
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$email,$encrypted],"ss");
    mysqli_stmt_close($res);
    // Get userID from users db
    $sql = "SELECT `id` FROM `users` WHERE `email` = ?";
    $res = prepared_query($conn,$sql,[$email],"s");
    $res -> bind_result($id);
    $res -> fetch();
    mysqli_stmt_close($res);
    // Store UserID and UserEmail in session storage
    $_SESSION['loggedin'] = true;
    $_SESSION['userID'] = $id;
    $_SESSION['userEmail'] = $email;
}


?>