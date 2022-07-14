<?php
require "includes/connect.inc.php";
require "includes/verify.inc.php";
$teamname = $_POST["teamname"];
$teampassword = $_POST["teampassword"];
$email = $_POST["email"];
$password = $_POST["password"];

$errorlst = array();
$sql = "SELECT COUNT(*) FROM `teams` WHERE LOWER(TRIM(' 'FROM`teamname`)) = ?";
$res = prepared_query($conn,$sql,[$teamname],"s");
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
if ($count >= 1){
    header("Location: ../index.php?filename=teamcreationfail");
    exit();
}
$sql = "SELECT `teamname` FROM `users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
$res -> bind_result($testname);
$res -> fetch();
mysqli_stmt_close($res);
if ($testname != null){
    header("Location: ../index.php?filename=&alrhave=true");
    exit();
}
if (!verify_account($conn,$email,$password)){
    // header("Location: ../index.php?filename=login&criticalerror=true");
    // exit();
}
else{
    echo "This ran";
    $sql = "INSERT INTO `teams`(`teamname`,`teampassword`,`teammates`) VALUES (?,?,?)";
    $encryptedteam = password_hash($teampassword, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$teamname,$encryptedteam,json_encode([$email],JSON_FORCE_OBJECT)],"sss");
    mysqli_stmt_close($res);
    $sql = "UPDATE `users` SET `teamname` = ? WHERE `email` = ?";
    $res = prepared_query($conn,$sql,[$teamname,$email],"ss");
    mysqli_stmt_close($res);
    echo "<script>
        localStorage.setItem('userteam','$teamname');
        // window.location.href = '../index.php?filename=challenge';</script>
    ";
}


?>