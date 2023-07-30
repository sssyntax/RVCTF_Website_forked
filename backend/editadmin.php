<?php
    //Connect to the database
    require "includes/connect.inc.php";

    $email = $_POST['email'];

    //check if the email field is empty
    if ($email == ""){
        $error = 'nullerror';
    }
    //check if the email is valid (although there are a lot more cases where the email can be invalid)
    else if (strpos($email, '@') == false || strpos($email, '.') != true){
        $error = 'invalidemail';
    }

    if (isset($error)){
        header("Location: ../index.php?filename=editadmin&error=".json_encode($error));
        exit();
    }

    //check if user exists, and if so, if theyre admin or not 
    $sql = "SELECT `id`, `admin` FROM `ctf_users` WHERE `email` = ?";
    $res = prepared_query($conn, $sql, [$email], 's');
    $res -> bind_result($id, $admin);
    $res -> fetch();
    mysqli_stmt_close($res);


    if ($id == NULL){
        $error = 'nosuchuser';
        header("Location:../index.php?filename=editadmin&error=".json_encode($error));
        exit();
    }

    else {
        $sql = "UPDATE `ctf_users` SET `admin` = ? WHERE `id` = ?";
        if ($admin == 0){
            $response = array(
                'confirm' => true,
                'message' => "$email is not an admin, are you sure you want to give $email admin status?",
            );
            header("Content-Type: application/json");
            echo json_encode($response);
            
            $res = prepared_query($conn, $sql, [1, $id], 'ii');
            if ($res == false){
                $error = 'databaseerror';
                header("Location:../index.php?filename=editadmin&error=".json_encode($error));
                exit();
            }
            else {
                header("Location:../index.php?filename=editadmin&success=".json_encode('added'));
                exit();
            }
        }

        else if ($admin == 1){
            $res = prepared_query($conn, $sql, [0, $id], 'ii');
            if ($res == false){
                $error = 'databaseerror';
                header("Location:../index.php?filename=editadmin&error=".json_encode($error));
                exit();
            }
            else {
                header("Location:../index.php?filename=editadmin&success=".json_encode('removed'));
                exit();
           }
        }
    }

?>