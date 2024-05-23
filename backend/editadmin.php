<?php
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    onError($conn, "Invalid request method.");
}

$email = getPostParam('email');
if (empty($email)) {
    onError($conn, "nullerror");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    onError($conn, "invalidemail");
}

if (!verify_login($conn)) {
    onError($conn, "notloggedin");
}

$userid = $_SESSION['userid'];
$userInfo = getUserInfo($conn, $userid);
if (!$userInfo['admin']) {
    onError($conn, "notadmin");
}

$sql = "SELECT `id`, `admin` FROM `ctf_users` WHERE `email` = ?";
$result = fetchDataFromQuery($conn, $sql, [$email], 's', "Failed to fetch user information");

if (empty($result)) {
    onError($conn, "nosuchuser");
}

$user = $result[0];
$id = $user['id'];
$admin = $user['admin'];

if ($admin == 0) {
    $response = [
        'confirm' => true,
        'admin' => 0,
        'id' => $id,
        'message' => "$email is not an admin, are you sure you want to give $email admin status?"
    ];
    onSuccess($conn, "Confirmation needed", $response);
} elseif ($admin == 1) {
    $response = [
        'confirm' => true,
        'admin' => 1,
        'id' => $id,
        'message' => "$email is an admin, are you sure you want to remove admin status for $email?"
    ];
    onSuccess($conn, "Confirmation needed", $response);
}
?>
