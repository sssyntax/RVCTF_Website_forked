<title>Admin Panel</title>
<link rel="stylesheet" href="static/css/makeadmin.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'templates/Components/stars.php';?>

    <div id="admin-buttons">
        <a href="index.php?filename=editadmin" class="admin-button">Edit Admin</a>
        <a href="index.php?filename=createChallenge" class="admin-button">Create Challenge</a>

        <!-- 🔥 CTF State Testing Buttons -->
        <form method="post" action="backend/ctf_state_change.php" style="margin-top: 20px;">
            <button type="submit" name="action" value="notstarted" class="admin-button">Simulate CTF Not Started</button>
            <button type="submit" name="action" value="running" class="admin-button">Simulate CTF Running</button>
            <button type="submit" name="action" value="ended" class="admin-button">Simulate CTF Ended</button>
        </form>

        <!-- 🔥 Scoreboard Freeze/Unfreeze Buttons -->
        <form method="post" action="backend/scoreboard_freeze_toggle.php" style="margin-top: 40px;">
            <button type="submit" name="action" value="freeze" class="admin-button" style="background-color: #ffcc00;">Force Freeze Leaderboard</button>
            <button type="submit" name="action" value="unfreeze" class="admin-button" style="background-color: #00cc66;">Unfreeze Leaderboard</button>
        </form>
        <!-- 🔥 Casual Mode Button -->
        <form method="post" action="backend/casual_mode_toggle.php" style="margin-top: 20px;">
            <button type="submit" name="action" value="enable" class="admin-button" style="background-color: #3399ff;">Enter Casual Mode</button>
        </form>

    </div>
</body>


