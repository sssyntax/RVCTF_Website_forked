<!DOCTYPE html>
<head>
    <title>RVCTF Team Choice</title>
    <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
    <?php include "templates/stars.php" ?>
    <div class="header">Do you have a team?</div>
    <div style="height: 500px;">
    <table class="centre_box">  
        <tr>
            <td>
                <a href = "./index.php?filename=teamcreation">
                <button id = "teamcreate" value = "Create Team">Create Team</button>
                </a>
            </td>
        </tr>
        <tr>
            <td>
                <a href = "./index.php?filename=teamjoin">
                <button id = "teamjoin" value = "Join Team">Join Team</button>
                </a>
            </td>
        </tr>
    </table>
    </div>
    <p>Made in collaboration with Rdev</p>
</body>
</html>
