<?php
require_once "getsolvedcount2.php";
require_once "get_difficulty.php";

function calculateLogarithmicDecay($solveCount, $difficulty, $decayFactor = 5) {
    if ($difficulty === 0) {
        $minPoints = 50;
        $initialPoints = 100;
    } elseif ($difficulty === 1) {
        $minPoints = 100;
        $initialPoints = 150;
    } elseif ($difficulty === 2) {
        $minPoints = 250;
        $initialPoints = 300;
    } else {
        $minPoints = 100;
        $initialPoints = 150;
    }

    $decayAmount = log($solveCount + 1) * $decayFactor;
    $currentPoints = $initialPoints - $decayAmount;

    return max($minPoints, round($currentPoints));
}

function updateChallengePoints($conn, $challengeID) {
    $solveCount = getSolvedCount($conn, $challengeID);
    $difficulty = getDifficulty($conn, $challengeID);

    // First blood bonus based on difficulty
    if ($difficulty === 0) {
        $firstBloodBonus = 10;
    } elseif ($difficulty === 1) {
        $firstBloodBonus = 20;
    } elseif ($difficulty === 2) {
        $firstBloodBonus = 30;
    } else {
        $firstBloodBonus = 20;
    }

    $currentPoints = calculateLogarithmicDecay($solveCount, $difficulty);

    $sql = "UPDATE challenges SET points = ?, first_blood_bonus = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Failed to prepare update statement: " . $conn->error);
    }
    $stmt->bind_param("iii", $currentPoints, $firstBloodBonus, $challengeID);
    if (!$stmt->execute()) {
        throw new Exception("Failed to update challenge points and first blood bonus: " . $stmt->error);
    }
    $stmt->close();

    return ["new_points" => $currentPoints, "first_blood_bonus" => $firstBloodBonus];
}
