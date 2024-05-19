<?php
// Start session to access session data
session_start();    
require_once "includes/connect.inc.php";
require_once "includes/getinfo.inc.php";
require_once "includes/verify.inc.php";
$teamname = $_POST["team_name"];
$teampassword = $_POST["team_password"];
$userid = $_SESSION["userid"];
if (!verify_login()){
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
    // if the team does not exist
    $verifyresult = verify_team($conn,$teamname,$teampassword);
    if ($verifyresult === "noexist"){
        header("Location: ../index.php?filename=teamfail");
        exit();
    }
    // Password entered incorrect
    else if (!$verifyresult){
        header("Location: ../index.php?filename=teamjoin&error=".json_encode(["passworderror"]));
        exit();
    }
    // Successfully joined the team
    else{
        $email = $userinfo["email"];
        $teammates = json_decode(getteaminfo_name($conn,$teamname)["teammates"],true);
        if (!in_array($email,$teammates)){
            array_push($teammates,$email);
        }           
        // Update the team to reflect that the user has joined
        $sql = "UPDATE `teams` SET `teammates` = ? WHERE `teamname` = ?";
        $res = prepared_query($conn,$sql,[json_encode($teammates),$teamname],"ss");
        mysqli_stmt_close($res);
        // Update the user to reflect that the user has joined
        $sql = "UPDATE `ctf_users` SET `teamname` = ? WHERE `id` = ?";
        $res = prepared_query($conn,$sql,[$teamname,$userid],"si");
        // Store the team name in the session storage
        $_SESSION['teamname'] = $teamname;
        header("Location: ../index.php?filename=challenge");
    }
}
?>