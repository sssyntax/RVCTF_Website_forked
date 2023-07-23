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
            $sql = "SELECT email FROM ctf_users ORDER BY id ASC";
            $names = ($conn->query($sql))->fetch_all();
            foreach($names as $name){
                foreach($name as $nam){
                    $nam = strtoupper($nam);
                    echo "<option value = '$nam'>$nam</option>";
                }
            }
            ?>
        </select>
        <button value = "invite" id = "button" name = "InviteButton">Send invite</button>
    </form>
</body>
</html>
<?php
    if (isset($_POST['InviteButton'])){
        $user_email = $_POST['groupless-members'];
        $email = $_SESSION['userEmail'];
        $teamname = '';
        $stmt =  prepared_query($conn, "SELECT teamname FROM teams WHERE teamleader = ?", [$email,],"s");
        $stmt->bind_result($teamname);
        $stmt->fetch();
        mysqli_stmt_close($stmt);
        $sql = "SELECT COUNT(*) FROM pending_invite WHERE user_email = ? AND teamname = ?";
        $stmt = prepared_query($conn, $sql, [$user_email, $teamname], 'ss');
        $times = 0;
        $stmt->bind_result($times);
        $stmt->fetch();
        mysqli_stmt_close($stmt);
        if (strtoupper($user_email) == strtoupper($email)){
            echo "<script>alert('You cannot invite yourself ._.')</script>";
        } elseif($times == 0){
            $sql = "INSERT INTO pending_invite (user_email, teamname) VALUES (?, ?)";
            $stmt = prepared_query($conn, $sql, [$user_email, $teamname], 'ss');
            $stmt->close();
            $conn->close();   
        } else{
            echo "<script>alert('You have already invited this person')</script>";
        }
    }
?>
