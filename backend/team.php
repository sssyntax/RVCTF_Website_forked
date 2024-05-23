<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";

if (!verify_login($conn)) {
    onError($conn, "Please login again");
}

$userid = $_SESSION['userid'];
$teamstatus = getTeamStatusFromUserId($conn, $userid);

if (!$teamstatus) {
    onError($conn, "User is not part of a team");
}

$teamid = $teamstatus['teamid'];
$teamname = $teamstatus['teamname'];
$role = $teamstatus['position'];

$sql = "
    SELECT username,
        COALESCE(SUM(points), 0) AS total,
        team_name,
        ctf_users.id AS userid
    FROM teamates
    LEFT JOIN ctf_users ON teamates.user_id = ctf_users.id
    LEFT JOIN completedchallenges ON completedchallenges.user_id = ctf_users.id
    LEFT JOIN challenges ON completedchallenges.challenge_id = challenges.id
    LEFT JOIN teams ON teamates.team_id = teams.team_id
    WHERE teamates.team_id = ?
    GROUP BY ctf_users.id, username, team_name
    ORDER BY total DESC;
";

$teamates = fetchDataFromQuery($conn, $sql, [$teamid], 'i', "Failed to fetch team members");

$totalpoints = array_reduce($teamates, function($carry, $item) {
    return $carry + $item['total'];
}, 0);


