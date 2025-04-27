<?php
// import Db functionality
require_once "includes/connect.inc.php";

// Check if user is not here illegally
if (!verify_login($conn)) {
    onError($conn, "You are not logged in.");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
$isAdmin = $userInfo['admin'];

// ----------------------- CTF FREEZE SETUP -------------------------
$sql = "SELECT start_time, end_time, freeze_override, freeze_done FROM ctf_config WHERE id = 1";
$result = mysqli_query($conn, $sql);
$ctf_config = mysqli_fetch_assoc($result);

$now = time();
$freeze_time = $ctf_config['end_time'] - 1800; // 30 minutes before end
$freeze = false;
if (($now >= $freeze_time && $now <= $ctf_config['end_time']) || $ctf_config['freeze_override'] == 1) {
    $freeze = true;
}

// ----------------------- AUTO FREEZE TEAM POINTS -------------------------
if ($freeze && $ctf_config['freeze_done'] == 0) {
    // Only freeze once

    // Recalculate and update frozen_points for all teams
    $sql_teams = "SELECT team_id FROM teams";
    $result_teams = mysqli_query($conn, $sql_teams);
    while ($row_team = mysqli_fetch_assoc($result_teams)) {
        $team_id = $row_team['team_id'];

        $sql2 = "
        SELECT SUM(c.points) AS total_points
        FROM challenges c
        JOIN (
            SELECT DISTINCT cc.challenge_id
            FROM completedchallenges cc
            JOIN teamates t ON cc.user_id = t.user_id
            WHERE t.team_id = ?
        ) AS team_solves ON c.id = team_solves.challenge_id
        ";

        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $team_id);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
        $data2 = $res2->fetch_assoc();
        $total_points = $data2['total_points'] ?? 0;

        $sql3 = "UPDATE teams SET frozen_points = ? WHERE team_id = ?";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->bind_param("ii", $total_points, $team_id);
        $stmt3->execute();
    }

    // Mark freeze as completed
    $sql_done = "UPDATE ctf_config SET freeze_done = 1 WHERE id = 1";
    mysqli_query($conn, $sql_done);
}

// ----------------------- TEAMS -------------------------
$teams = [];

if ($freeze) {
    // During freeze: use frozen points from teams, filter only teams with points > 0
    $sql = "
    SELECT team_name, frozen_points AS points
    FROM teams
    WHERE frozen_points > 0
    ORDER BY points DESC;
    ";
} else {
    // Live calculation
    $sql = "
    SELECT team_name, SUM(points) AS points 
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
    ORDER BY points DESC;
    ";
}

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['team_name'])) {
        $clean_name = mb_convert_encoding($row['team_name'], 'UTF-8', 'UTF-8');
        $row['team_name'] = htmlspecialchars($clean_name);
    } else {
        $row['team_name'] = 'Unnamed Team';
    }
    array_push($teams, $row);
}

// ----------------------- USERS -------------------------
$users = [];

if ($freeze) {
    // During freeze: use frozen points for users, filter only users with points > 0
    $sql = "
    SELECT u.username, teams.team_name, u.frozen_points AS points
    FROM ctf_users u
    JOIN teamates t ON u.id = t.user_id
    JOIN teams ON t.team_id = teams.team_id
    WHERE u.frozen_points > 0
    ORDER BY points DESC;
    ";
} else {
    // Live calculation
    $sql = "
    SELECT u.username, teams.team_name, SUM(c.points) AS points 
    FROM ctf_users u
    JOIN completedchallenges uc ON u.id = uc.user_id
    JOIN challenges c ON uc.challenge_id = c.id
    JOIN teamates t ON u.id = t.user_id
    JOIN teams ON t.team_id = teams.team_id
    GROUP BY u.id
    ORDER BY points DESC;
    ";
}

$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['username'])) {
        $clean_username = mb_convert_encoding($row['username'], 'UTF-8', 'UTF-8');
        $row['username'] = htmlspecialchars($clean_username);
    } else {
        $row['username'] = 'Unnamed User';
    }

    if (!empty($row['team_name'])) {
        $clean_team = mb_convert_encoding($row['team_name'], 'UTF-8', 'UTF-8');
        $row['team_name'] = htmlspecialchars($clean_team);
    } else {
        $row['team_name'] = 'Unnamed Team';
    }

    array_push($users, $row);
}
?>
