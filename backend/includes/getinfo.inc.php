<?php
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