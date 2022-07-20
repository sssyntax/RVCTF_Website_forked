<?php
require "includes/connect.inc.php";
require "includes/verify.inc.php";
require "includes/getinfo.inc.php";
$teamname = $_POST["teamname"];
$teampassword = $_POST["teampassword"];
$info = json_decode($_POST["info"],true);
$userid = $info["userid"];
$keyid = $info["keyid"];
$sessionkey = $info["sessionkey"];

$errorlst = array();
$sql = "SELECT COUNT(*),`` FROM `teams` WHERE LOWER(TRIM(' 'FROM`teamname`)) = ?";
$res = prepared_query($conn,$sql,[$teamname],"s");
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
if ($count >= 1){
    //This is if there is an existing team
    header("Location: ../index.php?filename=teamcreationfail&teamleader=");
    exit();
}
$userinfo = getinfo($conn,$userid);
$email = $userinfo["email"];
$sql = "SELECT `teamname` FROM `users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$userid],"i");
$res -> bind_result($testname);
$res -> fetch();
mysqli_stmt_close($res);
if ($testname != null){
    //this happens when the user already has a team
    header("Location: ../index.php?filename=&alrhave=true");
    exit();
}
if (!verify_session($conn,$info)){
    //this happens when the user somehow changed their information
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}
else{
    //This is when everything is successful
    $sql = "INSERT INTO `teams`(`teamname`,`teampassword`,`teammates`) VALUES (?,?,?)";
    $encryptedteam = password_hash($teampassword, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$teamname,$encryptedteam,json_encode([$email],JSON_FORCE_OBJECT)],"sss");
    mysqli_stmt_close($res);
    $sql = "UPDATE `users` SET `teamname` = ? WHERE `id` = ?";
    $res = prepared_query($conn,$sql,[$teamname,$userid],"si");
    mysqli_stmt_close($res);
    echo "<script>
        localStorage.setItem('userteam','$teamname');
        window.location.href = '../index.php?filename=challenge';</script>
    ";
}


?>