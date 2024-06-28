    <title>Team</title>
    <link rel="stylesheet" href="static/css/team.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php require_once "backend/team.php";?>
    <?php include 'templates/Components/stars.php';?>
    <div class = "teaminfo">
        <h1><?= htmlspecialchars($teamname) ?></h1>
        <h2>Points: <?= htmlspecialchars($totalpoints) ?></h2>
        <?php if ($teamstatus['position'] == 'leader'){?>
            <div class = 'actions'>
                <input value = "DISBAND" class = "button disband" type="button">
                <a href = "index.php?filename=sendinvite"><input value = "INVITE" class = "button invite" type="button"></a>
            </div>
        <?php } else {?>
            <div class = 'actions'>
                <input value = "LEAVE" class = "button leave" type="button">
            </div>
        <?php } ?>
        
        <table class = "members">
        <colgroup>
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
        </colgroup>
        
            <tr class = "member">
                <th>Rank</th>
                <th>Username</th>
                <th>Score</th>
                <th></th>
            </tr>

            <?php foreach (array_values($teamates) as $placing => $teamate) { ?>
                <tr class = "member">
                    <td class = 'place'><?= $placing +1 ?></td>
                    <td class = "username"><?= htmlspecialchars($teamate['username']) ?></td>
                    <td class = "points"><?= htmlspecialchars($teamate['total']) ?></td>
                    <td>
                    <?php if ($teamstatus['position'] == 'leader'){?>    
                    <input 
                        data-userid = "<?= htmlspecialchars($teamate['userid']) ?>"
                        data-user = "<?= htmlspecialchars($teamate['username']) ?>"
                    value = "KICK" class = "kick button2" type="button">
                    <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <script src="static/js/teampages/team.js"></script>   
</body>