<?php
// start session
session_start();
require_once "backend/includes/connect.inc.php";
require_once "backend/includes/verify.inc.php";
$loggedin = verify_login($conn);
//echo sprintf($loggedin);
print_r($loggedin);
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
}
else{
    $filename = "";
}
// include stars styling
require_once("templates/Components/head.tpl.php");
if ($loggedin != False) {
    // Include components 
    switch ($filename) {
        // Logged in pages
        case 'editadmin':
            if ($_SESSION['admin']==1){
                include 'templates/Components/header.tpl.php';
                include 'templates/User Pages/editadmin.tpl.php';
            }
        break;
        case 'sendinvite':
            include 'templates/Components/header.tpl.php';
            include('templates/Login Pages/send_team_invite.tpl.php');
        break;
        case 'teamjoin':
            include 'templates/Components/header.tpl.php';
            include('templates/Login Pages/team_join_popup.tpl.php');
        break;
        case 'resources':
            include 'templates/Components/header.tpl.php';
            include('templates/User Pages/resources_page.tpl.php');
        break;
        case 'leaderboard':
            if ($_SESSION['admin'] == 1) {
                include('backend/leaderboard.php');
                include 'templates/Components/header.tpl.php';
                include('templates/User Pages/leaderboard.tpl.php');
            }
            else {
                // Send user to challenge page if they are not admin
                include('backend/challenge.php');
                include 'templates/Components/header.tpl.php';
                include('templates/User Pages/challenge_page.tpl.php');
            }
        break;
        case 'logout':
                // Reset the entire session
                session_reset();
                include('templates/Login Pages/login.tpl.php');
            break;
        case 'login':
            echo "Yes";
                include('templates/Login Pages/login.tpl.php');
            break;
        // Team joining & creation
        case 'teamsignup':
            echo "ran";
            include('templates/Login Pages/team_choice.tpl.php');  
        break;
        case 'teamcreation':
            include('templates/Login Pages/create_team.tpl.php');  
        break;
        case 'teamjoin':
            include('templates/Login Pages/join_team.tpl.php');  
        break;
        // Error messages
        case 'teamfail':
            include('templates/Login Pages/join_team_msg.tpl.php');  
        break;
        case 'teamcreationfail':
            include('templates/Login Pages/create_team_msg.tpl.php');
        break;
        case 'invite':
            include('templates/Login Pages/team_join_popup.tpl.php');
        break;
        default:
            include('backend/challenge.php');
            include 'templates/Components/header.tpl.php';
            include('templates/User Pages/challenge_page.tpl.php');
    }
}
// User not logged in
else {
    // Reset the entire session
    session_reset();
    switch ($filename) {
        case 'signup':
            include('templates/Login Pages/signup.tpl.php');  
        break;    
        default:
            include('templates/Login Pages/login.tpl.php');
    }
}

// FOR DEBUGGING PURPOSES, COMMENT OUT BEFORE LAUNCH
try {
    echo sprintf("<script>console.log('Curr ID: %s | Curr email: %s | Admin: %s | Logged in: %s')</script>", isset($_SESSION['userid']), isset($_SESSION['userEmail']), isset($_SESSION['admin']),$_SESSION['loggedin']);
}
catch(Exception $e) {
    echo "<script>console.log('Session not started')</script>";
}
// Add in footer component
include('templates/Components/footer.tpl.php');
?>