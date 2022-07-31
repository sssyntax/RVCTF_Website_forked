<?php
require "includes/connect.inc.php";
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirmpassword"];
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}
 
$errorlst = array();
if ($password != $confirm){
    array_push($errorlst,"matchingerror");
}
$sql = "SELECT COUNT(*) FROM `users` WHERE `email` = ?";
$res = prepared_query($conn,$sql,[$email],"s");
$res -> bind_result($count);
$res -> fetch();
mysqli_stmt_close($res);
if ($count >= 1){
    array_push($errorlst,"inuseerror");
}
if (count($errorlst)!=0){
    header("Location: ../index.php?filename=signup&error=".json_encode($errorlst));
}
else{
    $sql = "INSERT INTO `users`(`email`,`password`) VALUES (?,?)";
    $encrypted = password_hash($password, PASSWORD_DEFAULT);
    $res = prepared_query($conn,$sql,[$email,$encrypted],"ss");
    mysqli_stmt_close($res);
    // Get userID from users db
    $sql = "SELECT `id` FROM `users` WHERE `email` = ?";
    $res = prepared_query($conn,$sql,[$email],"s");
    $res -> bind_result($id);
    $res -> fetch();
    mysqli_stmt_close($res);
    // Store UserID and UserEmail in session storage
    $_SESSION['userID'] = $id;
    $_SESSION['userEmail'] = $email;
    // Generate Session & Session Key
    $randomkey = generate_string($permitted_chars,20);
    $hashed = hash('sha1',$randomkey);
    $sql = "INSERT INTO `keys`(`userid`,`sessionkey`) VALUES (?,?)";
    $res = prepared_query($conn,$sql,[$id,$hashed],"is");
    mysqli_stmt_close($res);
    // Fetch KeyID from the keys db
    $sql = "SELECT COUNT(*),`keyid` FROM `keys` WHERE `userid` = ?";
    $res = prepared_query($conn,$sql,[$id],"i");
    $res -> bind_result($count,$keyid);
    $res -> fetch();
    mysqli_stmt_close($res);

    if ($count >10){
        $sql = "DELETE TOP(1) FROM `keys` WHERE `userid` = ?";
        $res = prepared_query($conn,$sql,[$id],"i");
        mysqli_stmt_close($res);
    }

    $sessionkey = json_encode(["sessionkey"=>$randomkey,"userid"=>$id,"keyid"=>$keyid]);

    echo "<script>
        localStorage.setItem('sessioninfo','$sessionkey');
        window.location.href = '../index.php?filename=teamsignup';</script>
    ";
}


?>