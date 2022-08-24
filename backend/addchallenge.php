<?php
session_start();
require "includes/connect.inc.php";
require "includes/verify.inc.php";
if (verify_session()){
    // Check if fields are filled
    if (isset($_POST['title'])&&isset($_POST['author'])&&isset($_POST['points'])&&isset($_POST['difficulty'])&&isset($_POST['category'])&&isset($_POST['desc'])&&isset($_POST['solution'])){
        $title = $_POST['title'];
        $author =$_POST['author'];
        $points = $_POST['points'];
        $difficulty = $_POST['difficulty'];
        $category = $_POST['category'];
        $desc = htmlspecialchars($_POST['desc']);
        $solution = $_POST['solution'];

        // Check the db if the user is an admin
        $sql = "SELECT `admin` FROM `ctf_users` WHERE `id` = ?";
        $res =  prepared_query($conn,$sql,[$_SESSION['userID']],'i');
        $res -> bind_result($admin);
        $res -> fetch();
        mysqli_stmt_close($res);
        if ($admin){
            $salt = "3Y_J2ACWccfmI8ve?(q_fkLl"; //DO NOT SHARE THIS SALT
            $encrypted = sha1($salt.$solution);
            $sql = "INSERT INTO `challenges` (`title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $res =  prepared_query($conn,$sql,[$title,$author,$points,$difficulty,$category,$desc,$encrypted],'ssiisss');
            if ($res){
                echo json_encode("Success");
            }
            else{
                echo json_encode("Error2");
            }
            mysqli_stmt_close($res);
        }
        else{
            echo json_encode("Not Admin");
        }
    }
    // Not all fields filled
    else{
        echo json_encode("Error1");
    }
}
else{
    echo json_encode("Relogin");
}
?>