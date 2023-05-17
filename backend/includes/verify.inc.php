<?php
function verify_account($conn,$email,$password){
    $sql = "SELECT `password` FROM `ctf_users` WHERE `email` = ?";
    $result = prepared_query($conn,$sql,[$email],"s");
    $result -> bind_result($encrypted);
    $result -> fetch();
    mysqli_stmt_close($result);
    return password_verify($password,$encrypted);
}
// function verify_session($conn,$data){
//     $sql = "SELECT `sessionkey`,`userid` FROM `keys` WHERE `keyid` = ?";
//     $result = prepared_query($conn,$sql,[$data['keyid']],"i");
//     $result -> bind_result($encrypted,$userid);
//     $result -> fetch();
//     mysqli_stmt_close($result);
//     return (hash('sha1',$data['sessionkey'])==$encrypted && $userid == $data['userid']);

// }
function verify_login($conn){
    // Check if the person is already logged in
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){// && isset($_SESSION['userid'])){;'
        // Extracting user details from db
        $sql = "SELECT `email`,`teamname`,`points`,`admin` FROM `ctf_users` WHERE `id` = ?";
        $cursor = prepared_query($conn,$sql,[$_SESSION['userid'],],'i');
        $cursor->bind_result($email,$teamname,$points,$admin);
        // If the data fetched is unsuccessful, it will return false
        // IE the user is not in the database
        if (!($cursor->fetch())) {
            print_r("data fetched unsuccessfully");
            return false;
        }      
        else {
            $_SESSION['userEmail'] = $email;
            $_SESSION['admin'] = $admin;
            $_SESSION['teamname'] = $teamname;
            $_SESSION['points'] = $points;
            return true;
        }
        // It will return the data that is fetched
    }
    // person is not logged in
    else{
        // rememberMe will set loggedin & userid
        // When verify_login is recursively called, the condtiiton above will be true
        if (rememberMe($conn)){
            //print_r("User has a cookie\n");
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