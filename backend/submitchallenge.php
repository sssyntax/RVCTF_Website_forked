<?php
// Start session & access session details
session_start();
$userID = intval($_SESSION["userID"]);
$email = $_SESSION["userEmail"];
require "includes/connect.inc.php";
require "includes/verify.inc.php";
// Check if the user is logged in
if (verify_session()) {
    // Check if fields are set
    if (isset($_POST['id']) && isset($_POST["answer"])) {
        // Grab details about challenge
        $id = intval($_POST['id']);
        $answer = $_POST["answer"];
        // Query database for challenge
        $sql = "SELECT `solution`, `points` FROM `challenges` WHERE `id` = ?";
        $res =  prepared_query($conn,$sql,[$id],'i');
        $res -> bind_result($solution, $points);
        $res -> fetch();
        mysqli_stmt_close($res);
        //DO NOT SHARE THIS SALT
        $salt = "3Y_J2ACWccfmI8ve?(q_fkLl";
        // Hash the submitted answer 
        $encrypted = sha1($salt.$answer);
        // Check if hashed answer is equal to the stored solution
        if ($encrypted == $solution) {
            // Sucess variable tracks any errors, changed when errors encountered
            $success = true;
            // Add completion record to completion database
            $sql = "INSERT INTO `completedchallenges`(`userid`, `challengeid`, `timestamp`) VALUES (?, ?, ?)";
            $res =  prepared_query($conn,$sql,[$userID, $id, time()],'iii');
            // Query is unsucessful
            if (!$res){
                echo json_encode("Database error");
                $success = false;
                exit();
            }
            mysqli_stmt_close($res);
            // Award the user the points
            $sql = "UPDATE `users` SET `points` = `points` + ? WHERE `id` = ?";
            $res =  prepared_query($conn,$sql,[$points, $userID],'ii');
            // Query is unsucessful
            if (!$res){
                echo json_encode("Database error");
                $success = false;
                exit();
            }
            mysqli_stmt_close($res);
            // No errors encountered
            if ($success) {
                echo json_encode("Correct answer");
            }
        } 
        else {
            echo json_encode('Wrong answer');
        }
    }
    // Not all fields filled, return error
    else {
        echo json_encode("Not all fields filled");
    }
}
// Prompt user to login
else{
    echo json_encode("Relogin");
    header("Location: ../index.php?filename=login");
}
?>