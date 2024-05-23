<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
header('Content-Type: application/json');
function deleteTeamIfEmpty($conn, $teamid) {
    $sql = "SELECT COUNT(*) as teamcount FROM `teamates` WHERE `team_id` = ?";
    $result = fetchDataFromQuery($conn, $sql, [$teamid], 'i', "Failed to fetch team information");
    if ($result[0]['teamcount'] === 0) {
        $sql = "DELETE FROM `teams` WHERE `team_id` = ?";
        executeQuery($conn, $sql, [$teamid], 'i', false, "Failed to delete team");
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    onError($conn, "Invalid request method.");
}

if (!verify_login($conn)) {
    onError($conn, "You are not logged in.");
}

$userid = $_SESSION['userid'];
$userInfo = getUserInfo($conn, $userid);
$teamInfo = getTeamStatusFromUserId($conn, $userid);

$sql = "DELETE FROM `teamates` WHERE `user_id` = ? AND `team_id` = ?";
executeQuery($conn, $sql, [$userid, $teamInfo['teamid']], 'ii',false,"Failed to remove user from team.");
deleteTeamIfEmpty($conn, $teamInfo['teamid']);

onSuccess($conn, "You have left the team");
