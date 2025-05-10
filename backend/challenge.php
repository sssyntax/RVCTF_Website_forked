<?php
require_once "includes/connect.inc.php";
require_once "includes/getinfo.inc.php";

$challenges = [];
$difficultylst = ["Easy", "Medium", "Hard"];
$separator = '|'; // Define a unique separator for file names

// Get user ID
$userid = intval($_SESSION['userid'] ?? 0);

if (!$userid) {
    die("You must be logged in to view challenges.");
}

// Get user's team ID
$sql = "SELECT team_id FROM teamates WHERE user_id = ?";
$teamResult = fetchDataFromQuery($conn, $sql, [$userid], 'i', "Failed to fetch team ID");

if (empty($teamResult)) {
    die("User is not part of a team.");
}

$teamid = $teamResult[0]['team_id'];

// Fetch all challenges with team/individual solves
$sql = "
    SELECT 
        CASE WHEN ts.challenge_id IS NOT NULL THEN 1 ELSE 0 END AS teamsolved,
        CASE WHEN cc.challenge_id IS NOT NULL THEN 1 ELSE 0 END AS individualsolved,
        c.id,
        c.title,
        c.author,
        c.difficulty,
        c.points,
        c.category,
        c.description,
        COALESCE(sc.solve_count, 0) AS solve_count,
        COALESCE(am.file_names, '') AS file_names
    FROM challenges c
    LEFT JOIN (
        SELECT challenge_id, COUNT(*) AS solve_count
        FROM completedchallenges
        GROUP BY challenge_id
    ) sc ON c.id = sc.challenge_id
    LEFT JOIN (
        SELECT challenge_id
        FROM team_solves
        WHERE team_id = ?
    ) ts ON c.id = ts.challenge_id
    LEFT JOIN (
        SELECT challenge_id
        FROM completedchallenges
        WHERE user_id = ?
    ) cc ON c.id = cc.challenge_id
    LEFT JOIN (
        SELECT challenge_id, GROUP_CONCAT(file_name SEPARATOR '{$separator}') AS file_names
        FROM additional_materials
        GROUP BY challenge_id
    ) am ON c.id = am.challenge_id
    ORDER BY c.category, c.difficulty ASC, sc.solve_count DESC
";


$results = fetchDataFromQuery($conn, $sql, [$teamid, $userid], "ii");

foreach ($results as $row) {
    // Mark challenge as completed if solved by team or individually
    $row['completed'] = $row['teamsolved'] || $row['individualsolved'] ? 1 : 0;

    // Split file names into an array
    $row['file_names'] = !empty($row['file_names']) ? explode($separator, $row['file_names']) : [];
    $row['file_names'] = array_map('htmlspecialchars', $row['file_names']);
    $row['file_names'] = json_encode($row['file_names']);

    // Add to the challenges array
    if (!isset($challenges[$row['category']])) {
        $challenges[$row['category']] = [];
    }
    $challenges[$row['category']][] = $row;
}

// Now $challenges is ready to be used in your frontend
?>
