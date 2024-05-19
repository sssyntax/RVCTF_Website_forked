<?php
$sql = "SELECT username,SUM(points) as total,teamname  FROM teamates
        JOIN ctf_users ON teamates.user_id = ctf_users.id
        JOIN completedchallenges ON completedchallenges.userid = ctf_users.id
        JOIN challenges ON completedchallenges.challengeid = challenges.id
        JOIN teams ON teamates.team_id = teams.teamid
        WHERE teamates.team_id = ?
        GROUP BY ctf_users.id
        ORDER BY total DESC;
        ";
$teamstatus = getTeamStatusFromUserId($conn,$userid);
$teamid =$teamstatus['teamid'];
$teamname = $teamstatus['teamname'];
$role = $teamstatus['position'];
$res = prepared_query($conn,$sql,[$teamid],"i");
$cursor = iimysqli_stmt_get_result($res);
$teamates = [];
$totalpoints = 0;
while ($row = iimysqli_result_fetch_assoc_array($cursor)){
    array_push($teamates,$row);
    $totalpoints += $row['total'];

}
mysqli_stmt_close($res);
