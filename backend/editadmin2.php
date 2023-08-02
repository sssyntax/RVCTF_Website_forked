<?php
    require "includes/connect.inc.php";
    $success = false;
    $message = '';

    //collect confirmform info
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $confirm = $_POST['confirm'] ?? '';
        $admin = $_POST['admin'] ?? '';
        $email = $_POST['email'] ?? '';
        $id = $_POST['id'] ?? '';

        $sql = "UPDATE `ctf_users` SET `admin` = ? WHERE `id` = ?";
        
        //update database
        if (isset($confirm) and $confirm == true){
            if ($admin == 0){
                $res = prepared_query($conn, $sql, [1, $id], 'ii');
                if ($res == false){
                    $message = 'databaseerror';
                }
                else {
                    $sql2 = "SELECT `admin` FROM `ctf_users` WHERE id = ?";
                    $res2 = prepared_query($conn, $sql2, [$id], 'i');
                    $res2 -> bind_result($check);
                    $res2 -> fetch();
                    if ($check == 1){
                        $success = true;
                        $message = "$email is now an admin.";
                    }
                }
                mysqli_stmt_close($res2);
            }

            else if ($admin == 1){
                $res = prepared_query($conn, $sql, [0, $id], 'ii');
                if ($res == false){
                    $message = 'databaseerror';
                }
                else {
                    $sql2 = "SELECT `admin` FROM `ctf_users` WHERE id = ?";
                    $res2 = prepared_query($conn, $sql2, [$id], 'i');
                    $res2 -> bind_result($check);
                    $res2 -> fetch();
                    if ($check == 0){
                        $success = true;
                        $message = "$email is no longer an admin.";
                    }
                }
                mysqli_stmt_close($res2);
            }

            //send success and admin status back to tpl
            $response = array(
                'success' => $success,
                'message' => $message,
            );
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    }
