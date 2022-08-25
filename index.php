<?php
// start session
session_start();
require_once "backend/includes/verify.inc.php";
$loggedin = verify_session();
if (isset($_GET['filename'])){
    $filename = $_GET['filename']; 
}
else{
    $filename = "";
}

switch ($filename) {
    case 'signup':
        include('templates/Login Pages/signup.tpl.php');  
    break;
    case 'login':
        include('templates/Login Pages/login.tpl.php');
    break;
    case 'teamsignup':
        include('templates/Login Pages/team_choice.tpl.php');  
    break;
    case 'teamcreation':
        include('templates/Login Pages/create_team.tpl.php');  
    break;
    case 'teamjoin':
        include('templates/Login Pages/join_team.tpl.php');  
    break;
    case 'teamfail':
        include('templates/Login Pages/join_team_msg.tpl.php');  
    break;
    case 'teamcreationfail':
        include('templates/Login Pages/create_team_msg.tpl.php');
    break;
    case 'resources':
        if ($loggedin) {
            include('templates/User Pages/resources_page.tpl.php');
        }
        else {
            include('templates/Login Pages/login.tpl.php');
        }
    break;
    case 'leaderboard':
        if ($loggedin && $_SESSION['admin'] == 1) {
            include('backend/leaderboard.php');
            include('templates/User Pages/leaderboard.tpl.php');
        }
        else if ($loggedin) {
            include('backend/challenge.php');
            include('templates/User Pages/challenge_page.tpl.php');
        }
        else {
            include('templates/Login Pages/login.tpl.php');
        }
    break;
    case 'logout':
        // End the old session
        session_destroy();
        // start a new session
        session_start();
        include('templates/Login Pages/login.tpl.php');
    break;
    default:
        if (($filename == ''||$filename=="home"||$filename=="challenge") && $loggedin) {

            include('backend/challenge.php');
            include('templates/User Pages/challenge_page.tpl.php');
        }
        else{
            // Terminate the previous session
            session_destroy();
            // Start a new session
            session_start();
            include('templates/Login Pages/login.tpl.php');
        }
}
// FOR DEBUGGING PURPOSES, COMMENT OUT BEFORE LAUNCH
try {
    echo sprintf("<script>console.log('Curr ID: %s | Curr email: %s | Admin: %s | Logged in: %s')</script>", $_SESSION['userID'], $_SESSION['userEmail'], $_SESSION['admin'],$_SESSION['loggedin']);
}
catch(Exception $e) {
    echo "<script>console.log('Session not started')</script>";
}
include('templates/Components/footer.tpl.php');
?>