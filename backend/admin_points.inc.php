<?php
require_once "backend/includes/connect.inc.php";
require_once "backend/includes/verify.inc.php";
if (!verify_login($conn)) {
    onError($conn, "Session invalid");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
$isAdmin = $userInfo['admin'];
if (!$isAdmin) {
    onError($conn, "Not Admin");
}

$sql = "SELECT `ctf_users`.`id`,`username`,`email`,COALESCE(SUM(`challenges`.`points`),0) + COALESCE(SUM(`admin_points`.`points`),0) as total_points,`team_name`
        FROM `ctf_users`
        LEFT JOIN `teamates` ON `teamates`.`user_id` = `ctf_users`.`id`
        LEFT JOIN `teams` ON `teams`.`team_id` = `teamates`.`team_id`
        LEFT JOIN `completedchallenges` ON `completedchallenges`.`user_id` = `ctf_users`.`id`
        LEFT JOIN `challenges` ON `challenges`.`id` = `completedchallenges`.`challenge_id`
        LEFT JOIN admin_points ON admin_points.user_id = ctf_users.id 
        GROUP BY `ctf_users`.`id`";

$results = fetchDataFromQuery($conn, $sql, [], "");
