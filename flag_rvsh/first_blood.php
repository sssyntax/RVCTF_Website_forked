<?php
function handleSolve($pdo, $challengeId, $userId, $solveCount) {
    // 1. Fetch challenge difficulty and first blood status
    $query = "SELECT difficulty, first_blood_user_id FROM challenges WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$challengeId]);
    $challenge = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$challenge) {
        throw new Exception("Challenge not found!");
    }

    $difficulty = $challenge['difficulty'];
    $firstBloodUserId = $challenge['first_blood_user_id'];

    $firstBlooded = false;

    // 2. Check if first blood is available
    if ($firstBloodUserId === null) {
        $firstBlooded = true;

        // 3. Update database to mark first blood
        $update = "UPDATE challenges SET first_blood_user_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($update);
        $stmt->execute([$userId, $challengeId]);
    }

    // 4. Calculate points
    $currentPoints = calculateLogarithmicDecay($solveCount, $difficulty, $firstBlooded);

    return $currentPoints;
}

// Make sure your calculateLogarithmicDecay function looks like the one we wrote earlier!
// With decayFactor = 30, first blood bonuses, etc.
?>
