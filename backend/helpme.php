<?php
require_once 'includes/connect.inc.php'; // make sure $conn is available here
require_once 'includes/getinfo.inc.php'; // if getPoints is defined here

$userid = 39; // or whatever user ID you want to test

$totalPoints = getPoints($conn, $userid);

echo "Total points for user $userid: $totalPoints";
?>
