<?php
require_once "backend/googleLogin.inc.php";
?>
 <?php 
    // Reset session details to log user out
        $_SESSION['loggedin'] = false;
        $_SESSION['userid'] = null;
        $_SESSION['userEmail'] = null;
        $_SESSION['admin'] = null;
    // set remember me cookie to expire
        setcookie('rememberme', '', time() - 3600);
    ?>
    <title>RVCTF Login</title>
    <link rel="stylesheet" href="static/css/login.css">
</head>
<body style="padding-top:50px">
   
        <?php include 'templates/Components/stars.php';?>

    <img src="static/images/RVCTF Neon Logo.png" id="cca_name">
    <div style="height:100px; min-height:75%; margin-top: 30px;">
        <table class="content">
            <tr>
                <td style="width: 25%; text-align: right;">
                    <img src="static/images/discord.png" id="discord_logo" class = 'social-media' onclick="location='https://discord.gg/uagKpY6c'"><br/>
                    <img src="static/images/instagram.png" id="IG_logo" class = 'social-media' onclick="location='https://www.instagram.com/rv.ctf/'">
                </td>
                <td>
                    <table class="centre_box">
                            <tr style="text-align: center;"><td class="header">Login</td></tr>
                            <tr style="text-align: center;">
                            
                                <td><div class = "google-login-button" onclick = "window.location.href = '<?php echo $googleUrl ?>'"></div></td>
                            </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>