<?php
require_once (dirname(__FILE__).'/getinfo.inc.php');

function verify_login($conn){
    // Check if the person is already logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){// && isset($_SESSION['userid'])){;'
        // Extracting user details from db
        $sql = "SELECT `email`,`admin` FROM `ctf_users` WHERE `id` = ?";
        $cursor = prepared_query($conn,$sql,[$_SESSION['userid'],],'i');
        $cursor->bind_result($email,$admin);
        // If the data fetched is unsuccessful, it will return false
        // IE the user is not in the database
        if (!($cursor->fetch())) {
            return false;
        } 
        mysqli_stmt_close($cursor);
        $teamstatus = getTeamStatusFromUserId($conn,$_SESSION['userid']);
        $_SESSION['userEmail'] = $email;
        $_SESSION['admin'] = $admin;
        if ($teamstatus){
            $_SESSION['teamname'] = $teamstatus['teamname'];
            $_SESSION['teamposition'] = $teamstatus['position'];
        }
        
        return true;
        
        // It will return the data that is fetched
    }
    // person is not logged in
    else{
        if (rememberMe($conn)){
            return verify_login($conn);
        } 
        else return false;
    };
}
function verify_team($conn,$teamname,$password){
    $sql = "SELECT `teampassword` FROM `teams` WHERE `teamname` = ?";
    $result = prepared_query($conn,$sql,[$teamname],"s");
    $result -> bind_result($encrypted);
    $result -> fetch();
    mysqli_stmt_close($result);
    if ($encrypted == null){
        return "noexist";
    }
    return password_verify($password,$encrypted);  
}
?>