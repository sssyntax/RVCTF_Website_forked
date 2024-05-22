<?php
session_start();
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
require_once "includes/getinfo.inc.php";

function addUserToTeam($conn, $userId, $teamId) {
    $sql = "INSERT INTO teamates(user_id, team_id) VALUES (?, ?)";
    executeQuery($conn, $sql, [$userId, $teamId], 'ii', false, "Failed to add user to team");
}

if (!verify_login($conn)) {
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}

$teamname = getPostParam("register_team_name");
$userid = $_SESSION["userid"];

if (!$teamname) {
    header("Location: ../index.php?filename=teamcreationfail&error=noname");
    exit();
}

// Check if a team with the same name already exists
$sql = "SELECT COUNT(*), `teamleader_id` FROM `teams` WHERE LOWER(TRIM(BOTH ' ' FROM `team_name`)) = ?";
$res = prepared_query($conn, $sql, [strtolower(trim($teamname))], "s");
$res->bind_result($count, $teamleader);
$res->fetch();
mysqli_stmt_close($res);

if ($count >= 1) {
    header("Location: ../index.php?filename=teamcreationfail&teamleader=" . $teamleader);
    exit();
}

if (!verify_login($conn)) {
    header("Location: ../index.php?filename=login&criticalerror=true");
    exit();
}

$userinfo = getUserInfo($conn, $userid);
$teamExists = getTeamStatusFromUserId($conn, $userid);

if ($teamExists) {
    header("Location: ../index.php?filename=challenge&alrhave=true");
    exit();
}

// Create new team with current user as team leader
$sql = "INSERT INTO `teams`(`team_name`, `teamleader_id`) VALUES (?, ?)";
executeQuery($conn, $sql, [$teamname, $userid], 'si', false, "Failed to create team");
$teamid = mysqli_insert_id($conn);

addUserToTeam($conn, $userid, $teamid);
$_SESSION['teamid'] = $teamid;

header("Location: ../index.php?filename=challenge");
exit();
?>
