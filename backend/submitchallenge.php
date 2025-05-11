<?php
session_start();
$userID = intval($_SESSION["userid"]);

require "includes/connect.inc.php";
require "includes/verify.inc.php";
require_once "first_blood_checker.php"; // ✅ include the refactored first blood checker

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

function getTeamID($conn, $userId) {
    $sql = "SELECT team_id FROM teamates WHERE user_id = ?";
    $result = fetchDataFromQuery($conn, $sql, [$userId], 'i', "Failed to fetch team ID");
    return $result[0]['team_id'] ?? null;
}

function teamHasSolved($conn, $teamId, $challengeId) {
    $sql = "SELECT 1 FROM team_solves WHERE team_id = ? AND challenge_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $teamId, $challengeId);
    $stmt->execute();
    $stmt->store_result();
    $exists = $stmt->num_rows > 0;
    $stmt->close();
    return $exists;
}

function insertTeamSolve($conn, $teamId, $challengeId) {
    $sql = "INSERT IGNORE INTO `team_solves`(`team_id`, `challenge_id`, `solve_time`) VALUES (?, ?, CURRENT_TIMESTAMP)";
    return executeQuery($conn, $sql, [$teamId, $challengeId], 'ii', true, "Failed to record team solve");
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

// Verify answer
if (verifyAnswer($conn, $id, $answer)) {
    $teamID = getTeamID($conn, $userID);
    
    if (!$teamID) {
        onError($conn, "You are not in a team.");
    }
    
    if (teamHasSolved($conn, $teamID, $id)) {
        // Team already solved it — no points for user
        onSuccess($conn, "Challenge already completed by your team! No points awarded.");
    } else {
        // Team has NOT solved it
        if (insertAnswer($conn, $id, $userID)) {
            insertTeamSolve($conn, $teamID, $id); // Record for team

            // ✅ Check and set first blood immediately after solve
            $firstBloodResult = checkAndSetFirstBlood($conn, $id);
            if ($firstBloodResult['status']) {
                // Optionally log or notify about first blood here
                // logEvent("First blood awarded for challenge {$id} by user {$firstBloodResult['first_blood_userid']}");
            }

            $points = getPoints($conn, $userID);
            onSuccess($conn, "Challenge Completed", ["points" => $points]);
        } else {
            onError($conn, "Please check your connection");
        }
    }
} else {
    onError($conn, "Incorrect Answer");
}
?>
