<?php
require "includes/connect.inc.php";
require "includes/verify.inc.php";
header("Content-Type: application/json");

if (!verify_login($conn)) {
    onError($conn, 'notloggedin');
}

$userid = $_SESSION['userid'];
$userInfo = getUserInfo($conn, $userid);
if (!$userInfo['admin']) {
    onError($conn, 'notadmin');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    onError($conn, 'Invalid request method');
}

$confirm = getPostParam('confirm');
$admin = getPostParam('admin');
$email = getPostParam('email');
$id = getPostParam('id');

if ($confirm != true){
    onError($conn, 'Invalid confirmation value');
}

$newAdminStatus = ($admin == 0) ? 1 : 0;
$sql = "UPDATE `ctf_users` SET `admin` = ? WHERE `id` = ?";
$res = executeQuery($conn, $sql, [$newAdminStatus, $id], 'ii', false, 'databaseerror');

$sql2 = "SELECT `admin` FROM `ctf_users` WHERE id = ?";
$result = fetchDataFromQuery($conn, $sql2, [$id], 'i', 'Failed to fetch updated admin status');

if (empty($result)) {
    onError($conn, 'databaseerror');
}

$check = $result[0]['admin'];
$success = ($check == $newAdminStatus);
$message = ($newAdminStatus == 1) ? "$email is now an admin." : "$email is no longer an admin.";

onSuccess($conn, $success, ['message' => $message]);

