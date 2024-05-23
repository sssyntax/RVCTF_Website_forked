<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
header('Content-Type: application/json');

if (!verify_login($conn)) {
    onError($conn, "You are not logged in.");
}

$userid = $_SESSION['userid'];
$teamstatus = getTeamStatusFromUserId($conn, $userid);

if ($teamstatus['position'] != "leader") {
    onError($conn, "Only the leader may disband the team.");
}

$teamid = $teamstatus['teamid'];
$sql = "DELETE FROM teams WHERE team_id = ?";
executeQuery($conn, $sql, [$teamid], "i", false, "Failed to disband the team");

onSuccess($conn, "Success");
