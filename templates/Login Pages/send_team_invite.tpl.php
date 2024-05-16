    <title>RVCTF Team Choice</title>
    <link rel="stylesheet" href="static/css/send_team_invite.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'templates/Components/stars.php';?>
    <form class="centre_box" method = "POST">
        <div class="header">Select Member</div>
        <h2>Invite a member to your team!</h2>
        <select name="groupless-members" id="groupless-members">
            <?php
            $sql = "SELECT email,id FROM ctf_users ORDER BY id ASC";
            $names = ($conn->query($sql))->fetch_all();
            foreach($names as $name){
                $nam = htmlspecialchars(strtoupper($name[0]));
                $id = $name[1];
                echo "<option value = '$id'>$nam</option>";
            }
            ?>
        </select>
        <button value = "invite" class = "button" id = "button" name = "InviteButton">Send invite</button>
    </form>
</body>
</html>
<?php
    function processInvite($conn,$memberid,$userid){
        if (!$userid === $memberid){
            echo "<script>alert('You can't invite yourself ._.')";
            return;         
        }

        $memberInfo = getUserInfo($conn,$memberid);
        if (!$memberInfo){
            echo "<script>alert('User not found.')";
            return;
        }
        $memberTeamStatus = getTeamStatusFromUserId($conn,$memberid);
        $myTeamStatus = getTeamStatusFromUserId($conn,$userid);
        if ($myTeamStatus['position'] != 'leader'){
            echo "<script>alert('Only the leader can make invites.')";
            return;
        }
        if ($memberTeamStatus){
            $team = $memberTeamStatus['teamname'];
            echo "<script>alert('This user is already in team $team')";
            return;
        }
        $sql = "SELECT * FROM pending_invite WHERE user_email = ? AND team_id = ?";
        $stmt = prepared_query($conn, $sql, [$memberInfo['email'], $myTeamStatus['teamid']], 'si');
        $stmt->store_result();
        if ($stmt->num_rows > 0){
            echo "<script>alert('Invite already sent to $memberInfo[email]')";
            return;
        }
        $stmt->close();
        $sql = "INSERT INTO pending_invite (user_email, team_id) VALUES (?, ?)";
        $email = $memberInfo['email'];
        $stmt = prepared_query($conn, $sql, [$email, $myTeamStatus['teamid']], 'si');
        $stmt->close();
        
        echo "<script>alert('Invite sent to $email!')";
    }
    if (isset($_POST['InviteButton']) && isset($_POST['groupless-members'])){
        $memberid = $_POST['groupless-members'];
        processInvite($conn,$memberid,$_SESSION['userid']);
        
    }
?>
