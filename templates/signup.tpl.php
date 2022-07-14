<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./static/css/signup.css?<?php echo time(); ?>">
    </head>
    <body>
        <form method = "POST" action = "./backend/signup.php">
            <div>
                <label for = "email">Email</label>
                <input id = "email" class = "nospace notempty"  name = "email" type = "email" maxlength = "512">
                <p id = "inuseerror" class = "errormsg">
                    Error! Email in use Already!
                </p>
            </div>
            <div>
                <label for = "password">Password</label>
                <input id = "password" class = "notempty" name = "password" type = "password" >
                <p id = "matchingerror" class = "errormsg">
                    Error! Passwords do not match!
                </p>
            </div>
            
            <div>
                <label for = "confirmpassword">Confirm Password</label>
                <input id = "confirmpassword" class = "notempty" name = "confirmpassword" type = "password" >
            </div>
            <input type = "submit"  value = "Register" onClick="return empty()">
        </form>
        
        <script src="./static/js/signup.js?<?php echo time(); ?>"></script>
    </body>
</html>