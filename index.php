<?php
session_start(); // Start session once the page is loaded 
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
        include('templates/Login Pages/teamsignup.tpl.php');  
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
        if ($filename == ''||$filename=="home"||$filename=="challenge" && $loggedin) {
            include('backend/challenge.php');
            include('templates/User Pages/challenge_page.tpl.php');
        }
        // else {
        //     header('HTTP/1.0 404 Not Found');
        //     include('tpl/page_not_found.tpl.php');
        // }
        else{
            include('templates/Login Pages/login.tpl.php');
        }
    break;
}
?>