<?php
require "includes/connect.inc.php";
require "includes/getinfo.inc.php";
require "includes/verify.inc.php";
$teamname = $_POST["teamname"];
$teampassword = $_POST["teampassword"];
$info = json_decode($_POST["info"],true);
$userid = $info["userid"];
$keyid = $info["keyid"];
$sessionkey = $info["sessionkey"];
if (!verify_session($conn,$info)){
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}
else{
    $userinfo = getinfo($conn,$userid);
    if ($userinfo["teamname"] != null){
        //happens when user already has teamname
        header("Location: ../index.php?filename=&alrhave=true");
        exit();
    }
    $verifyresult = verify_team($conn,$teamname,$teampassword);
    if ($verifyresult === "noexist"){
        header("Location: ../index.php?filename=teamfail");
        exit();
    }
    else if (!$verifyresult){
        header("Location: ../index.php?filename=teamjoin&error=".json_encode(["passworderror"]));
        exit();
    }
    else{
        $email = $userinfo["email"];
        $teammates = json_decode(getteaminfo_name($conn,$teamname)["teammates"],true);
        if (!in_array($email,$teammates)){
            array_push($teammates,$email);
        }           
        $sql = "UPDATE `teams` SET `teammates` = ? WHERE `teamname` = ?";
        $res = prepared_query($conn,$sql,[json_encode($teammates),$teamname],"ss");
        mysqli_stmt_close($res);

        $sql = "UPDATE `users` SET `teamname` = ? WHERE `id` = ?";
        $res = prepared_query($conn,$sql,[$teamname,$userid],"si");
        header("Location: ../index.php?filename=challenge");
    }
}
?>