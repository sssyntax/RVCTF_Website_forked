<?php
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
    $sql = "INSERT INTO `users`(`email`,`password`) VALUES (?,?,?)";
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$email,$encrypted],"sss");
    mysqli_stmt_close($res);
    $sql = "SELECT `id` FROM `users` WHERE `email` = ?";
    $res = prepared_query($conn,$sql,[$email],"s");
    $res -> bind_result($id);
    $res -> fetch();
    mysqli_stmt_close($res);
    echo "<script>
        localStorage.setItem('userpassword','$password');
        localStorage.setItem('useremail','$email');
        localStorage.setItem('userid',$id);
        window.location.href = '../index.php?filename=teamsignup';</script>
    ";
}


?>