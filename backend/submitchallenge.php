<?php
// Start session & access session details
session_start();
$userID = intval($_SESSION["userid"]);
require "includes/connect.inc.php";
require "includes/verify.inc.php";
// Check if the user is logged in
function verifyAnswer($conn,$challengeId,$answer){
    $sql = "SELECT `solution` FROM `challenges` WHERE `id` = ?;";
    $res = prepared_query($conn,$sql,[$challengeId],'i');
    $res -> bind_result($solution);
    $res -> fetch();
    mysqli_stmt_close($res);
    $salt = "3Y_J2ACWccfmI8ve?(q_fkLl";
    $encrypted = sha1($salt.$answer);
    if (hash_equals($encrypted,$solution)){
        return true;
    }
    return false;
}

function insertAnswer($conn,$challengeId,$userId){
    $sql = "INSERT INTO `completedchallenges`(`userid`, `challengeid`, `timestamp`) VALUES (?, ?, ?)";
    $res =  prepared_query($conn,$sql,[$userId, $challengeId, time()],'iii');
    if (!$res){
        return false;
    }
    mysqli_stmt_close($res);
    return true;
}
if (verify_login($conn)) {
    $userinfo = getUserInfo($conn, $userID);
    // Check if fields are set
    if (isset($_POST['id']) && isset($_POST["answer"])) {
        // Grab details about challenge
        $id = intval($_POST['id']);
        $answer = $_POST["answer"];
        if (verifyAnswer($conn,$id,$answer)){
            if (insertAnswer($conn,$id,$userID)){
                $points = getPoints($conn,$userID);
                onSuccess($conn,"Challenge Completed",[
                    "points" => $points]);
            }
            else{
                onError($conn,"Please check your connection");
            }
        }
        else{
            onError($conn,"Incorrect Answer");
        }
        
    }
    // Not all fields filled, return error
    else if (!isset($_POST['id'])) {
        onError($conn, "Please refresh the page");
    }
    else {
        onError($conn, "Please enter a flag");
    }
}
// Prompt user to login
else{
    onError($conn,"Please login again");
}
