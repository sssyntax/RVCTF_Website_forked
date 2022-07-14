<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./static/css/teampages/teamcreation.css?<?php echo time(); ?>">
    </head>
    <body>
    <form method = "POST" action = "./backend/teamcreation.php">
            <div>
                <label for = "teamname">Team Name</label>
                <input id = "teamname" class = "notempty" name = "teamname" maxlength = "255">
            </div>
            <div>
                <label for = "password">Password</label>
                <input id = "password" class = "nospace notempty"  name = "password" type = "password" maxlength = "512">
                <br>*Do share with your teammates
            </div>
            <input name = "email" type = "hidden" onload = "this.value = localStorage.getItem('useremail')">
            <input name = "password" type = "hidden" onload = "this.value = localStorage.getItem('userpassword')">
            <input type = "submit"  value = "Register" onClick="return empty()">
        </form>

        <script src="./static/js/teampages/teamcreation.js?<?php echo time(); ?>"></script>
    </body>
</html> 