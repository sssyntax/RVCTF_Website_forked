<?php
session_start();
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";

$difficultylst = ["Easy", "Medium", "Hard"];

if (!verify_login($conn)) {
    onError($conn, "Relogin required");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
if (!$userInfo['admin']) {
    onError($conn, "Not Admin");
}

$title = getPostParam('title');
$author = getPostParam('author');
$points = getPostParam('points');
$difficulty = getPostParam('difficulty');
$category = getPostParam('category');
$desc = getPostParam('desc');
$solution = getPostParam('solution');

if (!$title || !$author || !$points || $difficulty === false || !$category || !$desc || !$solution) {
    onError($conn, "All fields are required");
}

$encrypted = sha1(FLAG_SALT . $solution);

$sql = "INSERT INTO `challenges` (`title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`) VALUES (?, ?, ?, ?, ?, ?, ?)";
executeQuery($conn, $sql, [$title, $author, $points, $difficulty, $category, $desc, $encrypted], 'ssiisss');

onSuccess($conn, 1);
