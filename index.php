<?php
switch ($_GET['filename']) {
    case 'signup':
        include('templates/signup.tpl.php');  
    break;
    case 'teamsignup':
        include('templates/teampages/teamsignup.tpl.php');  
    break;
    case 'teamcreation':
        include('templates/teampages/teamcreation.tpl.php');  
    break;
    default:
        if ($_GET['filename'] == '') {
            include('tpl/home.tpl.php');
        }
        // else {
        //     header('HTTP/1.0 404 Not Found');
        //     include('tpl/page_not_found.tpl.php');
        // }
    break;
}
?>