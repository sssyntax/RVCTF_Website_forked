<?php
function calculateLogarithmicDecay($solveCount, $difficulty, $isFirstBlood = false, $decayFactor = 30) {
    // Set min, max, and initial points based on difficulty
    if ($difficulty === 'easy') {
        $minPoints = 50;
        $maxPoints = 150;
        $initialPoints = 150;
        $firstBloodBonus = 10;
    } elseif ($difficulty === 'medium') {
        $minPoints = 150;
        $maxPoints = 250;
        $initialPoints = 250;
        $firstBloodBonus = 20;
    } elseif ($difficulty === 'hard') {
        $minPoints = 300;
        $maxPoints = 400;
        $initialPoints = 400;
        $firstBloodBonus = 30;
    } else {
        // Default fallback
        $minPoints = 150;
        $maxPoints = 250;
        $initialPoints = 250;
        $firstBloodBonus = 20;
    }

    // Calculate decay
    $decayAmount = log($solveCount + 1) * $decayFactor;
    $currentPoints = $initialPoints - $decayAmount;
    
    // First blood bonus
    if ($isFirstBlood) {
        $currentPoints += $firstBloodBonus;
    }

    // Only clamp minimum points
    if ($currentPoints < $minPoints) {
        return $minPoints;
    } else {
        return round($currentPoints); // no max clamp anymore
    }
}

// test point decay
$solveCount = 5;
$difficulty = 'medium';
$isFirstBlood = true;

$currentPoints = calculateLogarithmicDecay($solveCount, $difficulty, $isFirstBlood);

echo "Current Points: $currentPoints";

?>
