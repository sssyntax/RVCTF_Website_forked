<!DOCTYPE html>
<html lang="en">
<head>
    <title>RVCTF Login</title>
    <link rel="stylesheet" href="static/css/login.css">
    <link rel="icon" type="image/x-icon" href="../../static/images/favicon.ico">
</head>
<body style="padding-top:50px">
    <?php 
    // Reset session details to log user out
        $_SESSION['loggedin'] = false;
        $_SESSION['userID'] = null;
        $_SESSION['userEmail'] = null;
        $_SESSION['admin'] = null;
    ?>
    <img src="static/images/RVCTF Neon Logo.png" id="cca_name">
    <div style="height:500px; min-height:100%; margin-top: 50px;">
        <table class="content">
            <tr>
                <td style="width: 25%; text-align: right;">
                    <img src="static/images/discord.png" id="discord_logo" class = 'social-media' onclick="location='https://discord.gg/uagKpY6c'"><br/>
                    <img src="static/images/instagram.png" id="IG_logo" class = 'social-media' onclick="location='https://www.instagram.com/rv.ctf/'">
                </td>
                <td>
                    <table class="centre_box">
                        <form method = "POST" action="backend/login.php">   
                            <tr style="text-align: center;"><td>Login</td></tr>
                            <tr style="text-align: center;">
                                <td>Email: <input type="text" name="login_username"></td>
                            </tr>
                            <tr style="text-align: center;">
                                <td>Password: <input type="password" name="login_password" width="auto" height="auto"></td>
                            </tr>
                            <?php 
                            if (isset($_GET["error"]) && strpos($_GET["error"], "notfounderror") != false) {
                                echo '
                            <tr>
                                <td class = "error_msg">Account does not exist, please register to access the site.</td>
                            </tr>';
                            }
                            else if (isset($_GET['attemptsleft'])) {
                                echo '
                                <tr>
                                    <td class = "error_msg">Incorrect password, please try again</td>
                                </tr>';
                            }
                            else if (isset($_GET['criticalerror'])) {
                                echo '
                                <tr>
                                    <td class = "error_msg">Session ended, please log in again</td>
                                </tr>';
                            }
                            ?>
                            <tr style="text-align: center;">
                                <td>
                                    <a href="index.php?filename=signup">Register</a>
                                    <button name = "action" type="submit" value="login">Login</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>