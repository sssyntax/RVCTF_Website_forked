<!DOCTYPE html>
<html lang="en">
<head>
    <title>RVCTF Login</title>
    <link rel="stylesheet" href="static/css/login.css">
</head>
<body style="padding-top:50px">
    <?php include "templates/stars.php" ?>
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
                <td style="text-align:center; width: 25%;">
                    <img src="static/images/discord.png" id="discord_logo" onclick="location='https://discord.gg/uagKpY6c'"><br/>
                    <img src="static/images/instagram.png" id="IG_logo"  onclick="location='https://www.instagram.com/rv.ctf/'">
                </td>
                <td>
                    <table class="centre_box">
                        <form method = "POST" action="backend/login.php">   
                            <tr style="text-align: center;"><td>Login</td></tr>
                            <tr style="text-align: center;">
                                <td>Username: <input type="text" name="login_username"></td>
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
                            ?>
                            <tr style="text-align: center;">
                                <td>
                                    <button name = "action" type="submit" value="register" style="margin-right: 10%;">Register</button>
                                    <button name = "action" type="submit" value="login">Login</button>
                                </td>
                            </tr>
                        </form>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <p style="color: white;">Made in collaboration with Rdev</p>
</body>
</html>