        <title>RVCTF Register</title>
        <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
<?php include 'templates/Components/stars.php';?>

    <div class="header">Registration</div>
    <div style="height: 600px;">
    <table class="centre_box">
        <form method = "POST" action = "backend/signup.php">
            <tr>
                <td>
                <label for = "email">Email</label>
                <input id = "email" class = "nospace notempty"  name = "email" type = "email" maxlength = "512">
                </td> 
            </tr>
            <tr>
                <td>
                    <label for = "password">Password</label>
                    <input id = "password" class = "notempty" name = "password" type = "password" >
                </td>
            </tr>
            <tr>
                <td>
                    <label for = "confirmpassword">Confirm Password</label>
                    <input id = "confirmpassword" class = "notempty" name = "confirmpassword" type = "password">
                </td>
            </tr>
            <?php if (isset($_GET['error'])) {
                if (strpos($_GET["error"], "nullerror") != false) {
                    echo '<tr>
                        <td class = "error_msg">Please fill up all fields</td>
                        </tr>';
                }
                else if (strpos($_GET["error"], "matchingerror") != false) {
                    echo '<tr>
                        <td class = "error_msg">Passwords do not match</td>
                    </tr>';
                }
                else if (strpos($_GET["error"], "inuseerror") != false) {
                    echo '<tr>
                        <td class = "error_msg">Account already exists, please login.</td>
                    </tr>';
                }
                
                    
            }?>
            <tr>
                <td>
                    <a href="index.php?filename=login"><button name = "action" id = 'login' type="button" value="login" style = 'margin-right: 2rem;'>Login</button></a> 
                    <button name = "action" id = 'register' type = 'submit' value = 'register'>Register</button>
                </td>
            </tr>
        </form>
    </table>
    </div>
</body>
</html>