<?php 
session_start();
require "includes/connect.inc.php";
require "includes/verify.inc.php";
if (verify_session()){
    if ($_SESSION['admin'] == 1) {
        $id = $_POST['id'];
        $sql = 'DELETE FROM `challenges` WHERE `id` = ?; ';
        $res = prepared_query($conn, $sql, [$id], 'i');
        mysqli_stmt_close($res);
        echo json_encode('Success');
    }
    else {
        echo json_encode("Not Admin");
    }
}
else {
    echo json_encode("Session invalid");
}
?>