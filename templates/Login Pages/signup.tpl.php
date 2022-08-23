<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RVCTF Register</title>
        <link rel="stylesheet" href="static/css/register.css">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "templates/stars.php" ?>
    <div class="header">Registration</div>
    <div style="height: 500px;">
    <table class="centre_box">
        <form method = "POST" action = "backend/signup.php">
            <tr>
                <td>
                <label for = "email">Email</label>
                <input id = "email" class = "nospace notempty"  name = "email" type = "email" maxlength = "512">
                <p id = "inuseerror" class = "errormsg">
                    Error! Email in use Already!
                </p>
                </td> 
            </tr>
            <tr>
                <td>
                    <label for = "password">Password</label>
                    <input id = "password" class = "notempty" name = "password" type = "password" >
                    <p id = "matchingerror" class = "errormsg">
                        Error! Passwords do not match!
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <label for = "confirmpassword">Confirm Password</label>
                    <input id = "confirmpassword" class = "notempty" name = "confirmpassword" type = "password">
                </td>
            </tr>
            <?php if (isset($_GET['error']) && strpos($_GET["error"], "inuseerror") != false) {
                echo '<tr>
                        <td class = "error_msg">Account already exists, please login.</td>
                    </tr>';
            }?>
            <tr>
                <td>
                    <button name = "action" type="submit" value="login" style = 'margin-right: 2rem;'>Login</button>
                    <button name = "action" type = 'submit' value = 'register'>Register</button>
                </td>
            </tr>
        </form>
    </table>
    </div>
    <script src="js/signup.js?<?php echo time(); ?>"></script>
</body>
</html>