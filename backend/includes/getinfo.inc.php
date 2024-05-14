<?php
function getTeamStatusFromUserId($conn, $userId){
    $sql = "SELECT 
                teams.teamname, 
                CASE 
                    WHEN teams.teamleader_id = ? THEN 'leader'
                    ELSE 'member'
                END AS status
            FROM 
                teams 
            JOIN 
                teamates ON teamates.team_id = teams.teamid
            WHERE 
                teamates.user_id = ?;
            ";
    $res = prepared_query($conn,$sql,[$userId,$userId],"ii");
    $res -> bind_result($teamname,$status);
    $res -> fetch();
    mysqli_stmt_close($res);
    return ["teamname"=>$teamname,"position"=>$status];
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
function getinfo($conn,$userid){
    $sql = "SELECT `email`,`teamname`,`points` FROM `ctf_users` WHERE `id` = ?";
    $res = prepared_query($conn,$sql,[$userid],"i");
    $res -> bind_result($email,$teamname,$points);
    $res -> fetch();
    mysqli_stmt_close($res);
    return ["email"=>$email,"teamname"=>$teamname,"points"=>$points];
}
function getteaminfo_id($conn,$teamid){
    $sql = "SELECT `teamname`,`points`,`teammates` FROM `teams` WHERE `id` = ?";
    $res = prepared_query($conn,$sql,[$teamid],"i");
    $res -> bind_result($teamname,$points,$teammates);
    $res -> fetch();
    mysqli_stmt_close($res);
    return ["teamname"=>$teamname,"points"=>$points,"teammates"=>$teammates];
}
function getteaminfo_name($conn,$teamname){
    $sql = "SELECT `teamid`,`points`,`teammates` FROM `teams` WHERE `teamname` = ?";
    $res = prepared_query($conn,$sql,[$teamname],"s");
    $res -> bind_result($teamid,$points,$teammates);
    $res -> fetch();
    mysqli_stmt_close($res);
    return ["teamid"=>$teamid,"points"=>$points,"teammates"=>$teammates];
}
?>