<!DOCTYPE html>
<head>
    <title>RVCTF Create Team</title>
    <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
    <?php include "templates/stars.php" ?>
    <div class="header">Create Team</div>
    <div style="height: 500px;">
    <table class="centre_box">
            <tr>
                <td>Team has already been created. Do request for the password from the team leader <?php if (isset($_GET['teamleader'])){echo "(".$_GET['teamleader'].")";}?> and join the team</td>
            </tr>
            <tr>
                <td>
                    <a href = "./index.php?filename=teamjoin">
                        <button class="button" type="submit">Join Team</button>
                    </a>
                </td>
            </tr>
    </table>
    </div>
</body>
</html>