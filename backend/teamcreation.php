<?php
session_start();
require "includes/connect.inc.php";
require "includes/verify.inc.php";
require "includes/getinfo.inc.php";
$teamname = $_POST["register_team_name"];
$teampassword = $_POST["register_team_password"];
$email = $_SESSION["userEmail"];
$userid = $_SESSION["userID"];


$errorlst = array();
$sql = "SELECT COUNT(*),`teamleader` FROM `teams` WHERE LOWER(TRIM(' 'FROM`teamname`)) = ?";
$res = prepared_query($conn,$sql,[$teamname],"s");
$res -> bind_result($count,$teamleader);
$res -> fetch();
mysqli_stmt_close($res);
if ($count >= 1){
    //This is if there is an existing team
    header("Location: ../index.php?filename=teamcreationfail&teamleader=".$teamleader);
    exit();
}
$userinfo = getinfo($conn,$userid);
$sql = "SELECT `teamname` FROM `users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$userid],"i");
$res -> bind_result($testname);
$res -> fetch();
mysqli_stmt_close($res);
if ($testname != null){
    //this happens when the user already has a team
    header("Location: ../index.php?filename=challenge&alrhave=true");
    exit();
}
if (!verify_session()){
    //this happens when the user somehow changed their information
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}
else{
    echo "Ran";
    //This is when everything is successful
    $sql = "INSERT INTO `teams`(`teamname`,`teampassword`,`teammates`,`teamleader`) VALUES (?,?,?,?)";
    $encryptedteam = password_hash($teampassword, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$teamname,$encryptedteam,json_encode([$email]),$email],"ssss");
    mysqli_stmt_close($res);
    $sql = "UPDATE `users` SET `teamname` = ? WHERE `id` = ?";
    $res = prepared_query($conn,$sql,[$teamname,$userid],"si");
    mysqli_stmt_close($res);    
    header("Location: ../index.php?filename=challenge");
}


?>