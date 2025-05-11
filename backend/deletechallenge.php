<?php 
session_start();
require "includes/connect.inc.php";
require "includes/verify.inc.php";

if (!verify_login($conn)) {
    onError($conn, "Session invalid");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
$isAdmin = $userInfo['admin'];
if (!$isAdmin) {
    onError($conn, "Not Admin");
}

// Get the ID of the challenge
$id = getPostParam('id');

if (!$id) {
    onError($conn, "Challenge ID is required");
}

// Delete the challenge from the challenges table
$sql = 'DELETE FROM `challenges` WHERE `id` = ?';
executeQuery($conn, $sql, [$id], "i", false, "Failed to delete challenge");

onSuccess($conn, "Success");
