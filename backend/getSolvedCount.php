<?php
require_once "includes/connect.inc.php";
header('Content-Type: application/json');

if (!isset($_GET['challengeID'])) {
    onError($conn, "No challenge id provided");
}

$challengeID = $_GET['challengeID'];

$sql = "SELECT COUNT(*) AS count FROM completedchallenges WHERE challenge_id = ?";
$result = fetchDataFromQuery($conn, $sql, [$challengeID], 'i', "Failed to fetch challenge completion count");

if (empty($result)) {
    onError($conn, "Error fetching challenge completion count");
}

$count = $result[0]['count'];
onSuccess($conn, "Success", ["data" => $count]);
