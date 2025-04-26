<?php
// import Db functionality
require_once "includes/connect.inc.php";
// Check if user is not here illegally (its RVCTF, can never be too safe)
if (!verify_login($conn)) {
    onError($conn, "You are not logged in.");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
$isAdmin = $userInfo['admin'];
//if (!$isAdmin) {
//    onError($conn, "You are not an admin.");
//} commented these out

// ----------------------- TEAMS -------------------------
$teams = [];
$sql = "SELECT team_name, SUM(points) AS points 
    FROM ( 
        SELECT t.team_id, c.id, c.points 
        FROM ctf_users u 
        JOIN teamates t ON u.id = t.user_id 
        JOIN completedchallenges uc ON u.id = uc.user_id 
        JOIN challenges c ON uc.challenge_id = c.id 
        GROUP BY t.team_id, c.id 
    ) AS team_challenges 
    JOIN teams ON team_challenges.team_id = teams.team_id 
    GROUP BY team_challenges.team_id
    ORDER BY points DESC;";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($teams, $row);
}

// ----------------------- USERS -------------------------
$users = [];
$sql = "SELECT u.username, teams.team_name, SUM(c.points) AS points 
    FROM ctf_users u
    JOIN completedchallenges uc ON u.id = uc.user_id
    JOIN challenges c ON uc.challenge_id = c.id
    JOIN teamates t ON u.id = t.user_id
    JOIN teams ON t.team_id = teams.team_id
    GROUP BY u.id
    ORDER BY points DESC;";

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    array_push($users, $row);
}
?>
