    <title>RVCTF Team Choice</title>
    <link rel="stylesheet" href="static/css/send_team_invite.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'templates/Components/stars.php';?>
    <div class="centre_box">
        <div class="header">Select Member</div>
        <h2>Invite a member to your team!</h2>
        <select name="groupless-members" id="groupless-members">
            <?php
            $sql = "SELECT name FROM ctf_users ORDER BY id ASC";
            $names = ($conn->query($sql))->fetch_all();
            foreach($names as $name){
                foreach($name as $nam){
                    $nam = strtoupper($nam);
                    echo "<option value = '$nam'>$nam</option>";
                }
            }
            ?>
        </select>
        <div>
            <button value = "invite" id = "button" onclick = 'sendinvite()'>Send invite</button>
        </div>
    </div>
</body>
</html>
<script>
    function sendinvite(){
        console.log('hi');
        <?php
            echo 'hello';
            $email = $_SESSION['userEmail'];
            echo $email;
            $sql = "SELECT teamname FROM teams WHERE teamleader = $email";
            $teamname1 = ($conn->query($sql))->fetch_all();
            foreach($teamname1 as $teamname2){
                $teamname = $teamname2;
            }
            echo $email, $teamname;
            $sql = "INSERT INTO pending_invite (user_email, teamname) VALUES ($email, $teamname)";
            $conn->query($sql);
        ?>
    }
</script>
