<?php
// Start session
session_start();
require_once "backend/includes/connect.inc.php";
require_once "backend/includes/verify.inc.php";

// Verify login status
$loggedin = verify_login($conn);
// FORCED LOGIN BYPASS (LOCAL ONLY)
// if (!$loggedin) {
//    $_SESSION['loggedin'] = true;
//    $_SESSION['userid'] = 39; // or any valid userid from your ctfdb
//    $_SESSION['admin'] = 1;  // 1 if you want admin rights
//    $loggedin = true;
// }

// Check if filename is set in GET request
$filename = isset($_GET['filename']) ? $_GET['filename'] : "";
function includePage($page, $data = [],$includeHeader = true) {
    foreach ($data as $key => $value) {
        $$key = $value;  // Create variable with name as key and value as value
    }
    if ($includeHeader) include 'templates/Components/header.tpl.php' ;
    include 'templates/' . $page;
}
// Include head template
require_once("templates/Components/head.tpl.php");

if ($loggedin) {
    // User is logged in
    $userid = $_SESSION['userid'];
    $points = getPoints($conn, $userid);
    $teamstatus = getTeamStatusFromUserId($conn, $userid);
    $userInfo = getUserInfo($conn, $userid);
    $isAdmin = $userInfo['admin'];
    
    $data = [
        'points' => $points,
        'teamstatus' => $teamstatus,
        'userInfo' => $userInfo,
        'isAdmin' => $isAdmin,
        'filename' => $filename,
        'conn' => $conn,
        'userid' => $userid
    ];
    
    
    switch ($filename) {
        case 'adminPanel':
            $isAdmin ? includePage('User Pages/adminPanel.tpl.php',$data) : 
                        includePage('User Pages/challenge_page.tpl.php',$data);
            break;
        case 'editadmin':
            $isAdmin ? includePage('User Pages/editadmin.tpl.php',$data) : 
                        includePage('User Pages/challenge_page.tpl.php',$data);
            break;
        case 'addpoints':
            $isAdmin ? includePage('User Pages/admin_points.tpl.php',$data) : 
                        includePage('User Pages/challenge_page.tpl.php',$data);
            break;
        case 'createChallenge':
            $isAdmin ? includePage('User Pages/create_challenge.tpl.php',$data) : 
                        includePage('User Pages/challenge_page.tpl.php',$data);
            break;
        
        case 'sendinvite':
            includePage('Team Pages/send_team_invite.tpl.php',$data);
            break;
        
        case 'team':
            $teamstatus? includePage('Team Pages/team.tpl.php',$data) : 
                        includePage('Team Pages/team_join_popup.tpl.php',$data);
            break;
        
        case 'leaderboard':
            //$isAdmin ? includePage('User Pages/leaderboard.tpl.php',$data) 
            //: includePage('User Pages/challenge_page.tpl.php',$data);
            includePage('User Pages/leaderboard.tpl.php',$data);
            break;
        
        case 'logout':
            session_reset();
            includePage('Login Pages/login.tpl.php', $data,false);
            break;
        
        case 'login':
            includePage('Login Pages/login.tpl.php', $data,false);
            break;
        
        case 'teamsignup':
            includePage('Login Pages/team_choice.tpl.php', $data,false);
            break;
        
        case 'teamcreation':
            includePage('Team Pages/create_team.tpl.php',$data);
            break;
        
        default:
            includePage('User Pages/challenge_page.tpl.php', $data);
            break;
    }
} else {
    // User not logged in
    $data = [
        'filename' => $filename,
        'conn' => $conn
    ];
    session_reset();
    includePage('Login Pages/login.tpl.php', $data,false);
}

// Add footer component
include('templates/Components/footer.tpl.php');
