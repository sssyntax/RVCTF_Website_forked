<?php
// Start session & access session details
session_start();
$userID = intval($_SESSION["userid"]);

require "includes/connect.inc.php";
require "includes/verify.inc.php";

function verifyAnswer($conn, $challengeId, $answer) {
    $sql = "SELECT `solution` FROM `challenges` WHERE `id` = ?";
    $result = fetchDataFromQuery($conn, $sql, [$challengeId], 'i', "Failed to fetch solution");

    if (empty($result)) {
        onError($conn, "Challenge not found");
    }

    $solution = $result[0]['solution'];
    $encrypted = sha1(FLAG_SALT . $answer);
    return hash_equals($encrypted, $solution);
}

function insertAnswer($conn, $challengeId, $userId) {
    $sql = "INSERT IGNORE INTO `completedchallenges`(`user_id`, `challenge_id`, `timestamp`) VALUES (?, ?, ?)";
    return executeQuery($conn, $sql, [$userId, $challengeId, time()], 'iii', true, "Failed to insert answer");
}

if (!verify_login($conn)) {
    onError($conn, "Please login again");
}

$userinfo = getUserInfo($conn, $userID);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    onError($conn, "Invalid request method");
}

$id = getPostParam('id');
$answer = getPostParam('answer');

if (!$id) {
    onError($conn, "Please refresh the page");
}

if (!$answer) {
    onError($conn, "Please enter a flag");
}

if (verifyAnswer($conn, $id, $answer)) {
    if (insertAnswer($conn, $id, $userID)) {
        $points = getPoints($conn, $userID);
        onSuccess($conn, "Challenge Completed", ["points" => $points]);
    } else {
        onError($conn, "Please check your connection");
    }
} else {
    onError($conn, "Incorrect Answer");
}
