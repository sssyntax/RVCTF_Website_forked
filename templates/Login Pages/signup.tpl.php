<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RVCTF Register</title>
        <link rel="stylesheet" href="css/register.css">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "templates/stars.php" ?>
    <div class="header">Register</div>
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
            <tr>
                <td><input type = "submit"  value = "Register" onClick="return empty()"></td>
            </tr>
        </form>
    </table>
    </div>
    <p>Made in collaboration with Rdev</p>
    <script src="js/signup.js?<?php echo time(); ?>"></script>
</body>
</html>