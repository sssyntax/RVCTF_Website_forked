<?php
function calculateLogarithmicDecay($initialPoints, $decayFactor, $solveCount, $difficulty) {
    // Set minimum points based on difficulty
    $difficultyMinPoints = [
        'easy' => 50,
        'medium' => 100,
        'hard' => 150
    ];
    
    // Default to 'medium' if unknown difficulty is given
    $minPoints = $difficultyMinPoints[$difficulty] ?? $difficultyMinPoints['medium'];
    
    // Calculate decay
    $decayAmount = log($solveCount + 1) * $decayFactor;
    $currentPoints = $initialPoints - $decayAmount;
    
    if ($currentPoints < $minPoints) {
        return $minPoints;
    } else {
        return round($currentPoints);
    }
}

// Example usage:
$initialPoints = 1000;
$decayFactor = 50;
$solveCount = 10;
$difficulty = 'hard'; // can be 'easy', 'medium', 'hard'

$currentPoints = calculateLogarithmicDecay($initialPoints, $decayFactor, $solveCount, $difficulty);

echo "Current Points: $currentPoints";
?>
