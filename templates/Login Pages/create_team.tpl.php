    <title>RVCTF Create Team</title>
    <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
    <?php include 'templates/Components/stars.php';?>

    <div class="header">Create Team</div>
    <form method = "POST" action = "backend/teamcreation.php">
    <table id = "teamcreate-table" class="centre_box">
        
            <tr>
                <td>Team Name: <input id = "team-name" type="text" name="register_team_name" width="auto" height="auto"></td>
            </tr>
            <tr>
                <td><button class="button" type="submit">Enter</button></td>
            </tr>
        
    </table>
    </form>
</body>
</html>