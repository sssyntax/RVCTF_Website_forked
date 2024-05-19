<?php
session_start();
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
$difficultylst = ["Easy","Medium","Hard"];
if (verify_login($conn)){
    // Check if fields are filled
    $userInfo = getUserInfo($conn,$_SESSION['userid']);
    if (!$userInfo['admin']){
        echo json_encode(["error"=>"Not Admin"], JSON_FORCE_OBJECT);
        exit();
    }
    if (isset($_POST['title'])&&isset($_POST['author'])&&isset($_POST['points'])&&isset($_POST['difficulty'])&&isset($_POST['category'])&&isset($_POST['desc'])&&isset($_POST['solution'])){
        $title = $_POST['title'];
        $author =$_POST['author'];
        $points = $_POST['points'];
        $difficulty = array_search($_POST['difficulty'], $difficultylst);
        $category = $_POST['category'];
        $desc = htmlspecialchars($_POST['desc']);
        $solution = $_POST['solution'];

        $salt = "3Y_J2ACWccfmI8ve?(q_fkLl"; //DO NOT SHARE THIS SALT
        $encrypted = sha1($salt.$solution);
        $sql = "INSERT INTO `challenges` (`title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $res =  prepared_query($conn,$sql,[$title,$author,$points,$difficulty,$category,$desc,$encrypted],'ssiisss');
        if ($res){
            mysqli_stmt_close($res);
            $sql = "SELECT `id` FROM `challenges` WHERE `title` = ? AND `description` = ?; ";
            $res = prepared_query($conn, $sql, [$title, $desc], 'ss');
            $res -> bind_result($id);
            $res -> fetch();
            echo json_encode(["success"=>1], JSON_FORCE_OBJECT);
            mysqli_stmt_close($res);
        }
        else{
            echo json_encode(["error"=>"Please Check your Connection"], JSON_FORCE_OBJECT);
            mysqli_stmt_close($res);
        }
    }
    // Not all fields filled
    else{
        echo json_encode(["error"=>"Funny little hacker"], JSON_FORCE_OBJECT);
    }
}
else{
    echo json_encode(array("Relogin", 0), JSON_FORCE_OBJECT);
}
?>