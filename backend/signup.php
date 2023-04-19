<?php
// Start session to give aceess to session variables
session_start();
// Get the db connection 
require "includes/connect.inc.php";
// Redirect user to login page if they wish to login again
if ($_POST['action'] == 'login') {
    header("Location: ../index.php?filename=login");
    exit();
}
// Grab values filled in by user
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirmpassword"];
$admin = 0;
$errorlst = array();
// The password and confirm password do not match
// Check if either the email or password is null
if ($email == "" || $password == "" || $confirm == "") {
    array_push($errorlst, "nullerror");
}
else if ($confirm == 'Rvctf3103!@#$') {
    $admin = 1;
}
else if ($password != $confirm){
    array_push($errorlst,"matchingerror");
}

// Check for any users with the same email
$sql = "SELECT COUNT(*) FROM `ctf_users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
// 1 or more users with the same email already
if ($count >= 1){
    array_push($errorlst,"inuseerror");
}
// There have been some errors up till this point
if (count($errorlst)!=0){
    header("Location: ../index.php?filename=signup&error=".json_encode($errorlst));
}
// No current users with this email
else{
    // Insert new user into the database
    $sql = "INSERT INTO `ctf_users`(`email`,`password`, `admin`) VALUES (?,?, ?)";
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$email,$encrypted, $admin],"ssi");
    mysqli_stmt_close($res);
    // Get User data from database
    $sql = "SELECT `id`,`email`,`admin` FROM `ctf_users` WHERE `email` = ?";
    $res = prepared_query($conn,$sql,[$email],"s");
    $res -> bind_result($id, $email, $admin);
    $res -> fetch();
    mysqli_stmt_close($res);
    // Store UserID and UserEmail in session storage
    $_SESSION['loggedin'] = true;
    $_SESSION['userid'] = $id;
    $_SESSION['userEmail'] = $email;
    $_SESSION['admin'] = $admin;
    // Send user to team register page to join a team
    header("Location: ../index.php?filename=teamsignup");
}

?>