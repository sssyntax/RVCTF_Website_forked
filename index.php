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
echo sprintf("Curr ID: %s | Curr email: %s | Admin: %s | Logged in: %s", $_SESSION['userID'], $_SESSION['userEmail'], $_SESSION['admin'],$_SESSION['loggedin']);
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
        include('templates/Login Pages/create_team_msg.tpl.php');  
    break;
    default:
        if (($filename == ''||$filename=="home"||$filename=="challenge") && $loggedin) {
            include('backend/challenge.php');
            include('templates/User Pages/challenge_page.tpl.php');
        }
        else if ($filename == 'resources' && $loggedin) {
            include('templates/User Pages/resources_page.tpl.php');
        }
        else{
            include('templates/Login Pages/login.tpl.php');
        }
    break;
}
?>