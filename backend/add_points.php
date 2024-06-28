<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";

function addPoints($conn, $userid, $points) {
    $sql = "INSERT INTO `admin_points` (`admin_id`,`user_id`,`points`) VALUES (?,?,?)";
    executeQuery($conn, $sql, [$_SESSION['userid'], $userid, $points], 'iii');
}
if (!verify_login($conn)) {
    onError($conn, "Session invalid");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
$isAdmin = $userInfo['admin'];
if (!$isAdmin) {
    onError($conn, "Not Admin");
}

$points = getPostParam('points');
$userid = getPostParam('userid');
if (!$points || !$userid) {
    onError($conn, "All fields are required");
}

addPoints($conn, $userid, $points);
$newPoints = getPoints($conn, $userid);
onSuccess($conn, "Points added successfully", ['points' => $newPoints]);