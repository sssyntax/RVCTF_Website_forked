<?php 
session_start();
// import Db functionality
require "includes/connect.inc.php";
// Check if user is not here illegally (its RVCTF, can never be too safe)
if (!isset($_SESSION) || $_SESSION['loggedin'] != 1) {
    // Check if user is even logged in or has a session
    header("Location: ../index.php?filename=login");
    exit();
}
else if ($_SESSION['admin'] != 1) {
    // Check if user is an admin
    header("Location: ../index.php?filename=challenges");
    exit();
}
// Get user details from session
$userid = $_SESSION['userID'];
// Grab all users from database
$users = [];
$sql = "SELECT `id`, `email`, `points` FROM `ctf_users` ORDER BY `points` DESC; ";
$result = mysqli_query($conn,$sql);
// Save data into an associatve array (like python dictionary)
// Iterate through every single row in the result to convert to associative array 
while ($row = mysqli_fetch_assoc($result)) {
    // Add the row to the array of all users 
    array_push($users, $row);
}
?>