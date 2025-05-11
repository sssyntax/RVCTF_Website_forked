<?php
function getTeamStatusFromUserId($conn, $userId){
    $sql = "SELECT 
                teams.team_name, 
                CASE 
                    WHEN teams.teamleader_id = ? THEN 'leader'
                    ELSE 'member'
                END AS status,
                teams.team_id
            FROM 
                teams 
            JOIN 
                teamates ON teamates.team_id = teams.team_id
            WHERE 
                teamates.user_id = ?;
            ";
    $res = prepared_query($conn,$sql,[$userId,$userId],"ii");
    $res -> bind_result($teamname,$status,$teamid);
    if (!($res -> fetch())) return false;
    mysqli_stmt_close($res);
    return ["teamname"=>$teamname,"position"=>$status,"teamid"=>$teamid];
}

// function getPoints($conn,$userid){
//     $sql = "SELECT SUM(challenges.points) + SUM(admin_points.points) FROM completedchallenges 
//             JOIN challenges ON completedchallenges.challenge_id = challenges.id
//             JOIN admin_points ON admin_points.user_id = completedchallenges.user_id 
//             WHERE completedchallenges.user_id = ?";
//     $res = prepared_query($conn,$sql,[$userid],"i");
//     $res -> bind_result($points);
//     $res -> fetch();
//     mysqli_stmt_close($res);
//     $points = $points ? $points : 0;
//     return $points;
// }

// new get points function to include first blood bonus
function getPoints($conn, $userid) {
    // Get sum of challenge points (with double points logic) + admin points
    $sql = "
        SELECT 
            COALESCE(SUM(
                CASE 
                    WHEN c.double_points = 1 THEN c.points * 2
                    ELSE c.points
                END
            ), 0) AS challenge_points,
            COALESCE(SUM(a.points), 0) AS admin_points
        FROM completedchallenges cc
        JOIN challenges c ON cc.challenge_id = c.id
        LEFT JOIN admin_points a ON a.user_id = cc.user_id
        WHERE cc.user_id = ?
    ";
    $res = prepared_query($conn, $sql, [$userid], "i");
    $res->bind_result($challengePoints, $adminPoints);
    $res->fetch();
    mysqli_stmt_close($res);

    // Get sum of first blood bonuses (only once per challenge, if user was first)
    $sql_bonus = "SELECT COALESCE(SUM(c.first_blood_bonus), 0)
                  FROM challenges c
                  JOIN completedchallenges cc ON cc.challenge_id = c.id
                  WHERE cc.user_id = ?
                  AND cc.timestamp = (
                      SELECT MIN(cc2.timestamp)
                      FROM completedchallenges cc2
                      WHERE cc2.challenge_id = c.id
                  )";
    $res_bonus = prepared_query($conn, $sql_bonus, [$userid], "i");
    $res_bonus->bind_result($firstBloodBonus);
    $res_bonus->fetch();
    mysqli_stmt_close($res_bonus);

    // Final total: (Challenge points with double points logic) + Admin points + First blood bonuses
    return ($challengePoints ?: 0) + ($adminPoints ?: 0) + ($firstBloodBonus ?: 0);
}

function getUserInfo($conn,$userid){
    $sql = "SELECT username,email,admin FROM ctf_users WHERE id = ?";
    $res = prepared_query($conn,$sql,[$userid],"i");
    $res -> bind_result($username,$email,$admin);
    if (!($res -> fetch())) return false;
    mysqli_stmt_close($res);
    return ["username"=>$username,"email"=>$email,"admin"=>$admin];
}

function getPostParam($param) {
    return isset($_POST[$param]) ? htmlspecialchars($_POST[$param]) : null;
}

function getGetParam($param) {
    return isset($_GET[$param]) ? htmlspecialchars($_GET[$param]) : null;
}
?>