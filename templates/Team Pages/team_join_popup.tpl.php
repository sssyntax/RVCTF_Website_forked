<link rel="stylesheet" href="static/css/team_join_popup.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'templates/Components/stars.php'; ?>
    <?php include 'backend/teamjoin.php'; ?>
    <?php if ($invite) { ?>
        <h1>You have been invited to <?= htmlspecialchars($invite['team_name']) ?></h1>
        <div id="Content">
            <h2 id="team_leader">Team leader: <?= htmlspecialchars($invite['teamleader']) ?><br>
                (<?= htmlspecialchars($invite['teamleaderemail']) ?>)</h2>
            <div class="dropdown">
                <div class="dropbtn button--secondary" onclick="show()"><b>Team members</b></div>
                <div id="dropdown-content">
                    <?php
                    foreach ($invite["members"] as $teammember) {
                        $teammember = htmlspecialchars($teammember['username']);
                        echo "<div id = 'dd_content' class = 'button--secondary'>$teammember</div>";
                    }
                    ?>
                </div>
            </div>
            <form method="POST">
                <input type="hidden" name="teamid" value="<?= $invite['team_id'] ?>">
                <button class="button button-medium accept " name="actionAccept" type="submit" value="Accept">Accept</button>
                <button class="button button-medium reject" name="actionDecline" type="submit" value="Decline">Decline</button>
            </form>
        </div>
    <?php } else { ?>
        <h1>You have no pending invites</h1>
    <?php } ?>
    <a style = "margin:auto; display:block; width:fit-content;" href = "index.php?filename=teamcreation">
        <input type="button" class="button" value="Create Team" onclick="window.location.href='index.php?page=team'">
    </a>
</body>

<script>
    var FirstTime = true
    function show() {
        if (FirstTime == true) {
            document.getElementById("dropdown-content").style.display = "block";
            FirstTime = false
        }
        else {
            if (document.getElementById("dropdown-content").style.display == "none") {
                document.getElementById("dropdown-content").style.display = "block";
            }
            else {
                document.getElementById("dropdown-content").style.display = "none";
            }
        }

    }
</script>