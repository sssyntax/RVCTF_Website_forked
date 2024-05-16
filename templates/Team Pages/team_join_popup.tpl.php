<link rel="stylesheet" href="static/css/team_join_popup.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>

<body>
    <?php include 'templates/Components/stars.php'; ?>
    <?php
    function checkPendingInvite($conn, $teamid, $email)
    {
        $sql = "SELECT COUNT(*) FROM pending_invite WHERE user_email = ? AND team_id = ?";
        $stmt = prepared_query($conn, $sql, [$email, $teamid], 'ss');
        $times = 0;
        $stmt->bind_result($times);
        $stmt->fetch();
        mysqli_stmt_close($stmt);
        if ($times == 0) {
            return false;
        }
        return true;
    }
    function deleteInvite($conn, $teamid, $email)
    {
        $sql = "DELETE FROM pending_invite WHERE user_email = ? AND team_id = ?";
        $stmt = prepared_query($conn, $sql, [$email, $teamid], 'si');
        mysqli_stmt_close($stmt);
    }
    function acceptInvite($conn, $teamid, $email, $userid)
    {
        $sql = "INSERT IGNORE INTO teamates (team_id,user_id) VALUES (?,?)";
        $stmt = prepared_query($conn, $sql, [$teamid, $userid], 'ii');
        mysqli_stmt_close($stmt);
        echo "<script>alert('You have successfully joined the team!')
            window.location.href = 'index.php?page=team';
            </script>";
    }
    function declineInvite()
    {
        echo "<script>alert('You have declined the invite!')</script>";
    }

    $useremail = $_SESSION['userEmail'];
    if (isset($_POST['teamid']) && (isset($_POST['actionAccept']) || isset($_POST['actionDecline']))) {
        $teamid = $_POST['teamid'];
        if (!checkPendingInvite($conn, $teamid, $useremail)) {
            echo "<script>alert(`Error! Can't find this invite! Please contact an Admin if you suspect this is an error.`)</script>";
            return false;
        }
        deleteInvite($conn, $teamid, $useremail);
        if (isset($_POST['actionAccept'])) {
            acceptInvite($conn, $teamid, $email, $_SESSION['userid']);
        } else {
            declineInvite();
        }
    }
    ?>

    <?php

    function getGroupMembers($conn, $teamid)
    {
        $sql = "SELECT ctf_users.username as username FROM teamates
                JOIN ctf_users ON teamates.user_id = ctf_users.id
                WHERE team_id = ?";
        $res = prepared_query($conn, $sql, [$teamid], "i");
        $cursor = iimysqli_stmt_get_result($res);
        $members = [];
        while ($row = iimysqli_result_fetch_assoc_array($cursor)) {
            array_push($members, $row);
        }
        return $members;
    }
    function getPendingInvite($conn, $useremail)
    {
        $sql = "SELECT teamname,ctf_users.username as teamleader,ctf_users.email as teamleaderemail, teamid FROM pending_invite 
                JOIN teams ON pending_invite.team_id = teams.teamid
                JOIN ctf_users ON teams.teamleader_id = ctf_users.id
                WHERE pending_invite.user_email = ?
                LIMIT 1";
        $res = prepared_query($conn, $sql, [$useremail], "s");
        $cursor = iimysqli_stmt_get_result($res);
        
        $row = iimysqli_result_fetch_assoc_array($cursor);
        if (!$row)
            return false;
        mysqli_stmt_close($res);
        $members = getGroupMembers($conn, $row['teamid']);
        $row['members'] = $members;
        return $row;
    }
    
    $invite = getPendingInvite($conn, $useremail);
    ?>
    <?php if ($invite) { ?>
        <h1>You have been invited to <?= htmlspecialchars($invite['teamname']) ?></h1>
        <div id="Content">
            <h2 id="team_leader">Team leader: <?= htmlspecialchars($invite['teamleader']) ?><br>
                (<?= htmlspecialchars($invite['teamleaderemail']) ?>)</h2>
            <div class="dropdown">
                <div class="dropbtn button--secondary" onclick="show()"><b>Team members</b></div>
                <div id="dropdown-content">
                    <?php
                    foreach ($invite["members"] as $teammember) {
                        $teammember = htmlspecialchars($teammember['username']);
                        echo "<div id = 'dd_content'>$teammember</div>";
                    }
                    ?>
                </div>
            </div>
            <form method="POST">
                <input type="hidden" name="teamid" value="<?= $invite['teamid'] ?>">
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