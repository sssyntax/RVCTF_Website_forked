<!DOCTYPE html>
<head>
    <title>RVCTF Join Team</title>
    <link rel="stylesheet" href="static/css/register.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include "templates/stars.php" ?>
    <div class="header">Join Team</div>
    <div style="height: 500px;">
    <table class="centre_box">
        <form method = "POST" action = "backend/teamjoin.php">
            <tr>
                <td>Team Name: <input type="text" name="team_name" width="auto" height="auto"></td>
            </tr>
            <tr>
                <td>Password: <input type="password" name="team_password" width="auto" height="auto">
                    <br><span style="font-size: 50%">*please request from team leader</span>
                </td>
            </tr>
            <tr>
                <td><button class="button" type="submit">Enter</button></td>
            </tr>
        </form>
    </table>
    </div>
</body>
</html>