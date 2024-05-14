<?php
session_start();
require "includes/connect.inc.php";
require "includes/verify.inc.php";
require "includes/getinfo.inc.php";
// initialise the values keyed in by the user

function addUserToTeam($conn,$userId,$teamId){
    $sql = "INSERT INTO teamates(user_id,team_id) VALUES (?,?)";
    $res = prepared_query($conn,$sql,[$userId,$teamId],'ii');
    mysqli_stmt_close($res);
}
$teamname = $_POST["register_team_name"];
$teampassword = $_POST["register_team_password"];
$userid = $_SESSION["userid"];
$errorlst = array();

// Check if a team with the same name already exists
$sql = "SELECT COUNT(*),`teamleader_id` FROM `teams` WHERE LOWER(TRIM(' 'FROM`teamname`)) = ?";
$res = prepared_query($conn,$sql,[$teamname],"s");
$res -> bind_result($count,$teamleader);
$res -> fetch();
mysqli_stmt_close($res);
// There is an existing team with this name
if ($count >= 1){
    // Direct user to fail message
    header("Location: ../index.php?filename=teamcreationfail&teamleader=".$teamleader);
    exit();
}
// Get the data of the user creating the team 
$userinfo = getinfo($conn,$userid);
$sql = "SELECT `teamname` FROM `ctf_users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$userid],"i");
$res -> bind_result($testname);
$res -> fetch();
mysqli_stmt_close($res);
// User already has a team
if ($testname != null){
    // redicrect them to the fail message
    header("Location: ../index.php?filename=challenge&alrhave=true");
    exit();
}
// User is not valid
if (!verify_login($conn)){
    print_r($logininfo);
    // header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}

// User is valid and currently has no team
else{
    // Create new team with current user as team leader
    $sql = "INSERT INTO `teams`(`teamname`,`teampassword`,`teamleader_id`) VALUES (?,?,?)";
    $encryptedteam = password_hash($teampassword, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$teamname,$encryptedteam,$userid],"ssi");
    mysqli_stmt_close($res);
    $teamid = mysqli_insert_id($conn);
    addUserToTeam($conn,$userid,$teamid);
    $_SESSION['teamid'] = $teamid;
    // Log the user into the site
    header("Location: ../index.php?filename=challenge");
}


?>