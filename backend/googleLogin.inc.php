<?php
session_start();
require_once "backend/google-api-php-client--PHP7.4/vendor/autoload.php";
require_once "backend/includes/connect.inc.php";
require_once "backend/googleLoginInfo.inc.php";

// Determine the origin
$origin = isset($_GET["origin"]) ? $_GET["origin"] : "Login";

// Create a Google Client
$client = new Google_Client();
$client->setClientId(clientID);
$client->setClientSecret(clientSecret);
$client->setRedirectUri(redirecturl);
$client->addScope("profile");
$client->addScope("email");
$client->addScope("openid");
$googleUrl = $client->createAuthUrl();

// Login function
function onLogin($conn, $user) {
    $_SESSION['userid'] = $user;
    $token = GenerateRandomToken(128); // Generate a token, should be 128 - 256 bits
    $tokenid = storeTokenForUser($conn, $user, $token);
    $cookie = $user . ':' . $token . ':' . $tokenid;
    $mac = hash_hmac('sha256', $cookie, SECRET_KEY); 
    $cookie .= ':' . $mac;
    setcookie('rememberme', $cookie, [
        'expires' => time() + (10 * 365 * 24 * 60 * 60),
        'path' => "/",
        'secure' => true,
        'httponly' => true
    ]);
}

function fromSchool($email,$name) {
    $exploded = explode(" ", rtrim($name, " "));
    $lastexploded = end($exploded);
    $fromrvhs = strtoupper($lastexploded) === "(RVHS)";
    return ($email == "students.edu.sg" && $fromrvhs) || $email == "moe.edu.sg";
}
if (isset($_GET['code'])) {
    session_destroy();
    session_start();

    if (isset($_COOKIE['rememberme'])) {
        setcookie("rememberme", "", time() - 3600, "/");
    }

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token["error"])) {
        echo "<script>window.location.href = 'index.php?filename=login'</script>";
        exit();
    }

    $client->setAccessToken($token);
    $gauth = new Google_Service_Oauth2($client);
    $google_info = $gauth->userinfo->get();

    $email = $google_info->email;
    $name = $google_info->name;
    $picture = $google_info->picture;

    if ($email) {
        // Check if the email exists in the database
        $result = fetchDataFromQuery($conn, "SELECT id, COUNT(*) as countof FROM `ctf_users` WHERE `email` = ?", [$email], "s", "Failed to fetch user information");

        if ($result[0]['countof'] > 0) {
            $id = $result[0]['id'];
            onLogin($conn, $id);
            verify_login($conn);

            $result = fetchDataFromQuery($conn, "SELECT COUNT(*) as times FROM pending_invite WHERE user_email = ?", [$email], 's', "Failed to fetch pending invites");

            if ($result[0]['times'] != 0) {
                header("Location: index.php?filename=invite");
            } else {
                header("Location: index.php?filename=Home");
            }
        } else {
            $exploded = explode(" ", rtrim($name, " "));
            $lastexploded = end($exploded);
            $fromrvhs = strtoupper($lastexploded) === "(RVHS)";

            if (fromSchool($google_info['hd'],$name)) {
                // Adding user's data to the database
                $id =  executeQuery($conn, "INSERT INTO `ctf_users`(`email`,`username`) VALUES (?,?)", [$email,$name], "ss", true, "Failed to insert user");
                onLogin($conn, $id);
                header("Location: index.php?filename=Home");
            } else {
                echo "<script>alert('Sorry! Only emails with the students.edu.sg or moe.edu.sg domain name, and from RVHS can signup!');
                window.location.href = '../../../index.php?filename=Login'</script>";
            }
        }
    }
}
?>
