    <link rel="stylesheet" href="static/css/team_join_popup.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Saira+Stencil+One&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'templates/Components/stars.php';?>
<?php
    #find the teamname that the user is being invited to
    $email = $_SESSION['userEmail'];
    $sql = "SELECT teamname FROM pending_invite WHERE user_email = ?";
    $stmt = prepared_query($conn, $sql, [$email], 's');
    $teamname = '';
    $stmt->bind_result($teamname);
    $stmt->fetch();
    mysqli_stmt_close($stmt);
    #find the team leader of the team that the user is being invited to
    $sql = "SELECT teamleader FROM teams WHERE teamname = ?";
    $stmt = prepared_query($conn, $sql, [$teamname], 's');
    $teamleader = '';
    $stmt->bind_result($teamleader);
    $stmt->fetch();
    mysqli_stmt_close($stmt);
    #find the team members of the team that the user is being invited to
    $sql = "SELECT teammates FROM teams WHERE teamname = ?";
    $stmt = prepared_query($conn, $sql, [$teamname], 's');
    $teammembersCopy = '';
    $stmt->bind_result($teammembersCopy);
    $stmt->fetch();
    mysqli_stmt_close($stmt);
    $teammembers = substr($teammembersCopy, 1, -1);
    $teammembers = explode(",",$teammembers);
?>
    <h1>You have been invited to <?php echo $teamname; ?></h1>
    <div id = "Content">
        <div id="team_leader">Team leader: <?php echo $teamleader; ?> </div>
        <div class="dropdown">
            <div class="dropbtn" onclick = "show()"><b>Team members</b></div>
            <div id="dropdown-content">
                <?php
                foreach($teammembers as $teammember){
                    $teammember = substr($teammember, 1, -1);
                    echo "<div id = 'dd_content'>$teammember</div>";
                }
                ?>
            </div>
        </div>
            <form method = "POST">
                <button name = "actionAccept" type="submit" value="Accept">Accept</button>
                <button name = "actionDecline" type="submit" value="Decline">Decline</button>
            </form>
    </div>
</body>
<?php
if (isset($_POST['actionAccept']) || isset($_POST['actionDecline'])){
    if (isset($_POST['actionAccept'])){
        $teammembersCopy = substr($teammembersCopy, 0, -1);
        $teammembersCopy .= ',"'.$_SESSION['userEmail'].'"]';
        $sql = "UPDATE teams SET teammates = ? WHERE teamname = ?";
        $stmt = prepared_query($conn, $sql, [$teammembersCopy, $teamname], 'ss');
        $sql = "UPDATE ctf_users SET teamname = ? WHERE email = ?";
        $stmt = prepared_query($conn, $sql, [$teamname, $email], 'ss');
    }
    $sql = "DELETE FROM pending_invite WHERE user_email = ? AND teamname = ?";
    $stmt = prepared_query($conn, $sql, [$email, $teamname], 'ss');
    #check if the user has anyone requests
    $sql = "SELECT COUNT(*) FROM pending_invite WHERE user_email = ?";
    $stmt = prepared_query($conn, $sql, [$email], 's');
    $times = 0;
    $stmt->bind_result($times);
    $stmt->fetch();
    mysqli_stmt_close($stmt);
    if ($times != 0){
        header("Location:index.php?filename=invite");
    } else{
        header("Location:index.php?filename=Home");
    }
}
?>
<script>
    var FirstTime = true
    function show(){
        if (FirstTime == true){
            document.getElementById("dropdown-content").style.display = "block";
            FirstTime = false
        }
        else{
            if (document.getElementById("dropdown-content").style.display == "none"){
            document.getElementById("dropdown-content").style.display = "block";
        }
        else{
            document.getElementById("dropdown-content").style.display = "none";
        }
        }
        
    }
</script>