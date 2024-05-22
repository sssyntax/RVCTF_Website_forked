<?php
require_once "includes/connect.inc.php";
require_once "includes/getinfo.inc.php";

$challenges = [];
$completed = [];
$difficultylst = ["Easy", "Medium", "Hard"];

// Get all challenges in the database
$sql = "
    SELECT 
        u.teamsolved, 
        v.individualsolved, 
        c.id, 
        c.title, 
        c.author, 
        c.difficulty, 
        c.points, 
        c.category, 
        c.description, 
        COALESCE(s.solve_count, 0) AS solve_count
    FROM `challenges` c
    LEFT JOIN (
        SELECT `challenge_id`, COUNT(*) AS `solve_count` 
        FROM `completedchallenges` 
        GROUP BY `challenge_id`
    ) s ON c.id = s.challenge_id
    LEFT JOIN (
        SELECT `challenge_id`, 1 AS teamsolved 
        FROM `completedchallenges` 
        JOIN teamates ON teamates.user_id = completedchallenges.user_id
        WHERE teamates.team_id IN (
            SELECT team_id FROM teamates WHERE user_id = ?
        )
        GROUP BY `challenge_id`, `teamates`.`team_id`
    ) u ON c.id = u.challenge_id
    LEFT JOIN (
        SELECT `challenge_id`, 1 AS individualsolved 
        FROM `completedchallenges` 
        WHERE `user_id` = ?
    ) v ON c.id = v.challenge_id
    ORDER BY c.category, c.difficulty ASC, s.solve_count DESC
";

// $res = mysqli_query($conn, $sql);
$results = fetchDataFromQuery($conn, $sql, [$userid, $userid], "ii");
foreach ($results as $row) {
    // Check if challenge has been completed
    $row['completed'] = $row['teamsolved'] || $row['individualsolved'] ? 1 : 0;

    // Add the challenge to the list of challenges
    if (!isset($challenges[$row['category']])) {
        $challenges[$row['category']] = [];
    }
    $challenges[$row['category']][] = $row;
}   

// The connection should remain open for further operations, if needed
