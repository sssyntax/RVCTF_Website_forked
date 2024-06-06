    <title>Admin Panel</title>
    <link rel="stylesheet" href="static/css/admin_points.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <?php require_once "backend/admin_points.inc.php"?>
    <div class = "content">
        <div>
            <input type = "text" id = "search" placeholder = "Search for user" class = "button button-medium">
            <input type = "number" id = "points_to_add" placeholder = "Points to Add" class = "button button-medium">
        </div>
    <table class = "users">
        <tr>
            <th>Username</th>
            <th>Points</th>
            <th>Team</th>
            <th></th>
        </tr>
        <?php foreach ($results as $row) { ?>
            <tr class = "user">
                <td class = "username"><?= htmlspecialchars($row['username']) ?></td>
                <td class = "total_points"><?= htmlspecialchars($row['total_points']) ?></td>
                <td class = "team_name"><?= htmlspecialchars($row['team_name']) ?></td>
                <td><button class = "add_points button button-medium" data-userid = "<?= $row['id']; ?>"
                        onclick="addPoints(this)">Add Points</button></td>
            </tr>
        <?php } ?>
    </table>
    </div>
    <script src = "static/js/admin_points.js"></script>
</body>