<?php
session_start();
require "includes/connect.inc.php";

// Check if user has keyed in any username or password
if (!isset($_POST["login_username"])||!isset($_POST["login_password"])){
    header("Location: ../index.php?filename=login");
}
// Redirect user to registration page if they clicked the button
if (isset($_POST['action']) && $_POST['action']==="register") {
    header("Location: ../index.php?filename=signup");
    exit();
}

// Get keyed in values of the username and password
$email = $_POST["login_username"];
$password = $_POST["login_password"];
$maxattempts = 5;
$errorlst = array();
// Find the user in the database
$sql = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
// Error connecting
if ($res === false){
    array_push($errorlst,"errorconnecting");
}
// Get result from database item
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
// No user in database
if ($count === 0){
    array_push($errorlst,"notfounderror");
}
// There was an error up to this point
if (count($errorlst) != 0){
    header("Location: ../index.php?filename=login&error=".json_encode($errorlst));
}
// User in the database
else{
    // Get userID from users db
    $sql = "SELECT users.id,password,COUNT(loginattempts.id),admin FROM `users` LEFT JOIN `loginattempts` ON users.id=userid AND timestamp>? WHERE `email` = ?  GROUP BY users.id";
    $hourago = time() - 60*60;
    // $hourago = 0;
    $res = prepared_query($conn,$sql,[$hourago,$email],"is");
    $res -> bind_result($id,$passwordhashed,$loginattempts,$admin);
    $res -> fetch();
    mysqli_stmt_close($res);
    if ($res !== false){
        // login attempts exceeded --> go back to login page
        if ($loginattempts>$maxattempts){
            array_push($errorlst,"lockederror");
            header("Location: ../index.php?filename=login&error=".json_encode($errorlst));
        }
        else{
            // User Login Successful
            if (password_verify($password,$passwordhashed)){
                // Remove any login attempt entries from the db
                $sql = "DELETE FROM `loginattempts` WHERE `userid` = ?";
                $res = prepared_query($conn,$sql,[$id],"i");
                mysqli_stmt_close($res);
                // Store UserID and UserEmail in session storage
                $_SESSION['loggedin'] = true;
                $_SESSION['userID'] = $id;
                $_SESSION['userEmail'] = $email;
                $_SESSION['admin'] = $admin;
                header("Location: ../index.php?filename=challenge");
            }
            else{
                $sql = "INSERT INTO `loginattempts` (`userid`,`timestamp`) VALUES (?,?)";
                print_r($id);
                $res = prepared_query($conn,$sql,[$id,time()],"ii");
                mysqli_stmt_close($res);
                header("Location: ../index.php?filename=login&attemptsleft=".($maxattempts-$loginattempts-1));

            }
            
        }
        
    }
    else{
        array_push($errorlst,"connectionerror");
        header("Location: ../index.php?filename=login&error=".json_encode($errorlst));
    }
}


?>