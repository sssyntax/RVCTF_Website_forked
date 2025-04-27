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

        <!-- 🔥 New CTF Testing Buttons -->
        <form method="post" action="backend/ctf_state_change.php" style="margin-top: 20px;">
            <button type="submit" name="action" value="notstarted" class="admin-button">Simulate CTF Not Started</button>
            <button type="submit" name="action" value="running" class="admin-button">Simulate CTF Running</button>
            <button type="submit" name="action" value="ended" class="admin-button">Simulate CTF Ended</button>
        </form>
    </div>
</body>
