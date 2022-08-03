<!DOCTYPE html>
<head>
    <title>RVCTF Create Team</title>
    <link rel="stylesheet" href="../../css/register.css">
</head>
<body>
    <?php include "../stars.php" ?>
    <div class="header">Create Team</div>
    <div style="height: 500px;">
    <table class="centre_box">
        <form method = "POST" action = "./backend/teamcreation.php">
            <tr>
                <td>Team Name: <input type="text" name="register_team_name" width="auto" height="auto"></td>
            </tr>
            <tr>
                <td>Password: <input type="password" name="register_team_password" width="auto" height="auto">
                    <br><span style="font-size: 50%">*do share with your teammates!</span>
                </td>
            </tr>
            <tr>
                <td><button class="button" type="submit">Enter</button></td>
            </tr>
        </form>
    </table>
    </div>
    <p>Made in collaboration with Rdev</p>
</body>
</html>