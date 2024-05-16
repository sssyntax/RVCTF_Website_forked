<?php
session_start();
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
require_once "includes/getinfo.inc.php";
// initialise the values keyed in by the user

function addUserToTeam($conn,$userId,$teamId){
    $sql = "INSERT INTO teamates(user_id,team_id) VALUES (?,?)";
    $res = prepared_query($conn,$sql,[$userId,$teamId],'ii');
    mysqli_stmt_close($res);
}
if (!verify_login($conn)){
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}

$teamname = $_POST["register_team_name"];
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
// User is not valid
if (!verify_login($conn)){
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}

// Get the data of the user creating the team 
$userinfo = getUserInfo($conn,$userid);
$teamExists = getTeamStatusFromUserId($conn,$userid);
// User already has a team
if ($teamExists){
    // redicrect them to the fail message
    header("Location: ../index.php?filename=challenge&alrhave=true");
    exit();
}


// User is valid and currently has no team
    // Create new team with current user as team leader
$sql = "INSERT INTO `teams`(`teamname`,`teamleader_id`) VALUES (?,?)";
$res = prepared_query($conn,$sql,[$teamname,$userid],"si");
mysqli_stmt_close($res);
$teamid = mysqli_insert_id($conn);
addUserToTeam($conn,$userid,$teamid);
$_SESSION['teamid'] = $teamid;
// Log the user into the site
header("Location: ../index.php?filename=challenge");



?>