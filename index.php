<?php
session_start(); // Start session once the page is loaded 
switch ($_GET['filename']) {
    case 'signup':
        include('templates/signup.tpl.php');  
    break;
    case 'login':
        include('templates/login.tpl.php');
    case 'teamsignup':
        include('templates/teampages/teamsignup.tpl.php');  
    break;
    case 'teamcreation':
        include('templates/teampages/teamcreation.tpl.php');  
    break;
    case 'teamjoin':
        include('templates/teampages/teamjoin.tpl.php');  
    break;
    case 'teamfail':
        include('templates/teampages/teamjoinfail.tpl.php');  
    break;
    default:
        if ($_GET['filename'] == ''||$_GET['filename']=="home"||$_GET['filename']=="challenge") {
            include('tpl/home.tpl.php');
        }
        // else {
        //     header('HTTP/1.0 404 Not Found');
        //     include('tpl/page_not_found.tpl.php');
        // }
    break;
}
?>