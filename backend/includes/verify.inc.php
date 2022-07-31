<?php
function verify_account($conn,$email,$password){
    $sql = "SELECT `password` FROM `users` WHERE `email` = ?";
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

function verify_session($data){
    return $_SESSION['userID'] == $data['userid'];
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