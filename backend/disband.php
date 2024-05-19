<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
header('Content-Type: application/json');
if (!verify_login($conn)) {
    echo json_encode("You are not logged in.");
    exit();
}

$userid = $_SESSION['userid'];
$teamstatus = getTeamStatusFromUserId($conn, $userid);

if ($teamstatus['position'] != "leader") {
    echo json_encode("Only the leader may disband the team.");
    exit();
}

$teamid = $teamstatus['teamid'];
$sql = "DELETE FROM teams WHERE teamid = ?";
prepared_query($conn, $sql, [$teamid], "i");

echo json_encode("Success");

