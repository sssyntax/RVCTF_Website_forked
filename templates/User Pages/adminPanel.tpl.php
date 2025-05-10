<title>Admin Panel</title>
<link rel="stylesheet" href="static/css/makeadmin.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'templates/Components/stars.php';?>
    <div id="admin-buttons" display="flex" style="display: flex; flex-direction: column; align-items: center; margin-top: 20px;">
        <div style="margin-top: 40px; display: flex; gap: 10px;">
            <a href="index.php?filename=editadmin" class="admin-button">Edit Admin</a>
            <a href="index.php?filename=createChallenge" class="admin-button">Create Challenge</a>
        </div>
        <!-- CTF State Testing Buttons -->
         <h1 style = "margin-top:40px">CTF State Testing</h1>
        <form method="post" action="backend/ctf_state_change.php" style="margin-top: 20px;">
            <button type="submit" name="action" value="notstarted" class="admin-button">Simulate CTF Not Started</button>
            <button type="submit" name="action" value="running" class="admin-button">Simulate CTF Running</button>
            <button type="submit" name="action" value="ended" class="admin-button">Simulate CTF Ended</button>
        </form>
        <h1 style = "margin-top:40px">Leaderboard/Mode Control</h1>
        <div style="margin-top: 40px; display: flex; gap: 10px;">
        <!-- Freeze/Unfreeze Buttons -->
            <form method="post" action="backend/scoreboard_freeze_toggle.php">
                <button type="submit" name="action" value="freeze" class="admin-button" style="background-color: #ffcc00;">
                    Force Freeze Leaderboard
                </button>
                <button type="submit" name="action" value="unfreeze" class="admin-button" style="background-color: #00cc66;">
                    Unfreeze Leaderboard
                </button>
            </form>
            <!-- Casual Mode Button -->
            <form method="post" action="backend/casual_mode_toggle.php">
                <button type="submit" name="action" value="enable" class="admin-button" style="background-color: #3399ff;">
                    Enter Casual Mode
                </button>
            </form>
        </div>
        <h1 style="margin-top: 40px">Points Control</h1>
        <!-- Double Points Button -->
        <form method="post" action="backend/double_points.php" style="margin-top: 20px;">
            <button type="submit" name="action" value="activate" class="admin-button" style="background-color: green;">
                Activate Double Points
            </button>
            <button type="submit" name="action" value="deactivate" class="admin-button" style="background-color: red;">
                Deactivate Double Points
            </button>
        </form>

    </div>