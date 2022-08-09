<?php
session_start();
require "includes/connect.inc.php";

if (!isset($_POST["login_username"])||!isset($_POST["login_password"])){
    header("Location: ../index.php?filename=login");
}
$email = $_POST["login_username"];
$password = $_POST["login_password"];
$maxattempts = 5;
$errorlst = array();
$sql = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
if ($res === false){
    array_push($errorlst,"errorconnecting");
}
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
if ($count === 0){
    array_push($errorlst,"notfounderror");
}
if (count($errorlst) != 0){
    header("Location: ../index.php?filename=login&error=".json_encode($errorlst));
}
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
        if ($loginattempts>$maxattempts){
            array_push($errorlst,"lockederror");
            header("Location: ../index.php?filename=login&error=".json_encode($errorlst));
        }
        else{
            if (password_verify($password,$passwordhashed)){
                // Store UserID and UserEmail in session storage
                $sql = "DELETE FROM `loginattempts` WHERE `userid` = ?";
                $res = prepared_query($conn,$sql,[$id],"i");
                mysqli_stmt_close($res);

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