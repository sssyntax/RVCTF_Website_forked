    <title>RVCTF Create Team</title>
    <link rel="stylesheet" href="static/css/register.css">
</head>
<body>
    <?php include 'templates/Components/stars.php';?>

    <h1 class="header">Create Team</h1>
    <?php if (!getTeamStatusFromUserId($conn,$userid)){?>
    <form method = "POST" onsubmit="submitForm(event)">
    
    <table id = "teamcreate-table" class="centre_box">
            <tr>
                <td class = "teamname">
                    Team Name: 
                    <input id = "team-name" class = "button--secondary" placeholder="Enter Team Name" type="text" name="register_team_name" width="auto" height="auto">
                </td>
            </tr>
            <tr>
                <td><button class="button" type="submit">Enter</button></td>
            </tr>
        
    </table>
    </form>
    <?php } else {?>
        <h2 class = "align-text-center">You are already in a team</h2>
    <?php }?>
    <script src="static/js/teampages/teamcreation.js"></script>
</body>
</html>