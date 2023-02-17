<?php
session_start();
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
    print_r($_SESSION);
    print_r("Hi");
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true && isset($_SESSION['userid'])){
        print_r("ran");
        $sql = "SELECT `email`,`teamname`,`points`,`admin` FROM `ctf_users` WHERE `id` = ?";
        $cursor = prepared_query($conn,$sql,[$_SESSION['id'],],'i');
        $cursor->bind_result($email,$teamname,$points,$admin);
        if (!($cursor->fetch())) return false;
        else return [$email,$teamname,$points,$admin];
    }
    else{
        print_r("Ran");
        if (rememberMe($conn)) return verify_login($conn);
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