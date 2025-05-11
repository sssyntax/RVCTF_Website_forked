<?php
require_once "includes/connect.inc.php"; // $conn

function fetchFirstSolver($conn, $challengeID) {
    $sql = "SELECT user_id FROM completedchallenges WHERE challenge_id = ? ORDER BY timestamp ASC LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        onError($conn, "Failed to prepare fetch statement: " . $conn->error);
    }

    $stmt->bind_param("i", $challengeID);
    if (!$stmt->execute()) {
        onError($conn, "Failed to execute fetch statement: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    return $row ? $row['user_id'] : null;
}

function updateFirstBlood($conn, $challengeID, $firstBloodUserId) {
    $sql = "UPDATE challenges SET firstblood_user_id = ?, first_blooded = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        onError($conn, "Failed to prepare update statement: " . $conn->error);
    }

    $stmt->bind_param("ii", $firstBloodUserId, $challengeID);
    if (!$stmt->execute()) {
        onError($conn, "Failed to update challenge: " . $stmt->error);
    }

    $stmt->close();
}

// ✅ MAIN FUNCTION to call
function checkAndSetFirstBlood($conn, $challengeID) {
    // Check if challenge exists
    $checkSql = "SELECT id, first_blooded FROM challenges WHERE id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $challengeID);
    $checkStmt->execute();
    $checkStmt->bind_result($id, $firstBlooded);
    if (!$checkStmt->fetch()) {
        $checkStmt->close();
        return ["status" => false, "message" => "Challenge not found"];
    }
    $checkStmt->close();

    if ($firstBlooded == 1) {
        return ["status" => false, "message" => "Challenge already first blooded"];
    }

    $firstBloodUserId = fetchFirstSolver($conn, $challengeID);
    if ($firstBloodUserId === null) {
        return ["status" => false, "message" => "No user has solved this challenge yet"];
    }

    updateFirstBlood($conn, $challengeID, $firstBloodUserId);

    return [
        "status" => true,
        "message" => "First blood set",
        "challenge_id" => $challengeID,
        "first_blood_userid" => $firstBloodUserId
    ];
}
