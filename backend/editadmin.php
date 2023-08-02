<?php
    //Connect to the database
    require "includes/connect.inc.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the email from the form data
        $email = $_POST['email'] ?? '';
        if (empty($email)) {
            $error = 'nullerror';
        }
        //check if the email is valid (although there are a lot more cases where the email can be invalid)
        else if (strpos($email, '@') == false || strpos($email, '.') != true){
            $error = 'invalidemail';
        }
    }

        // send error back to tpl
        if (isset($error)) {
            $response = array(
                'confirm' => false,
                'message' => $error,
            );
            $jsonData = json_encode($response);
            header('Content-Type: application/json');
            echo $jsonData;
            exit();
        }


    //check if user exists, and if so, if theyre admin or not 
    $sql = "SELECT `id`, `admin` FROM `ctf_users` WHERE `email` = ?";
    $res = prepared_query($conn, $sql, [$email], 's');
    $res -> bind_result($id, $admin);
    $res -> fetch();
    mysqli_stmt_close($res);

    // if cannot find user of that email
    if ($id == NULL){
        $error = 'nosuchuser';
        $response = array(
            'confirm' => false,
            'message' => $error,
        );
        header("Content-Type: application/json");
        echo json_encode($response);  
    }

    else {
        //send confirmation form details 
        if ($admin == 0){
            $response = array(
                'confirm' => true,
                'admin' => 0,
                'id' => $id,
                'message' => "$email is not an admin, are you sure you want to give $email admin status?",
            );
            header("Content-Type: application/json");
            echo json_encode($response);  
        }
        elseif ($admin == 1){
            $response = array(
                'confirm' => true,
                'admin' => 1,
                'id' => $id,
                'message' => "$email is an admin, are you sure you want to remove admin status for $email?",
            );
            header("Content-Type: application/json");
            echo json_encode($response);  
        }

        
    }

?>