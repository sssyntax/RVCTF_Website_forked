<?php
function getTeamStatusFromUserId($conn, $userId){
    $sql = "SELECT 
                teams.teamname, 
                CASE 
                    WHEN teams.teamleader_id = ? THEN 'leader'
                    ELSE 'member'
                END AS status,
                teams.teamid
            FROM 
                teams 
            JOIN 
                teamates ON teamates.team_id = teams.teamid
            WHERE 
                teamates.user_id = ?;
            ";
    $res = prepared_query($conn,$sql,[$userId,$userId],"ii");
    $res -> bind_result($teamname,$status,$teamid);
    if (!($res -> fetch())) return false;
    mysqli_stmt_close($res);
    return ["teamname"=>$teamname,"position"=>$status,"teamid"=>$teamid];
}

function getPoints($conn,$userid){
    $sql = "SELECT SUM(challenges.points) FROM completedchallenges 
            JOIN challenges ON completedchallenges.challengeid = challenges.id 
            WHERE completedchallenges.userid = ?";
    $res = prepared_query($conn,$sql,[$userid],"i");
    $res -> bind_result($points);
    $res -> fetch();
    mysqli_stmt_close($res);
    return $points;
}

function getUserInfo($conn,$userid){
    $sql = "SELECT username,email,admin FROM ctf_users WHERE id = ?";
    $res = prepared_query($conn,$sql,[$userid],"i");
    $res -> bind_result($username,$email,$admin);
    if (!($res -> fetch())) return false;
    mysqli_stmt_close($res);
    return ["username"=>$username,"email"=>$email,"admin"=>$admin];
}
?>