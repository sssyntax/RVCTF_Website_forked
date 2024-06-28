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
        $sql = "SELECT team_name,ctf_users.username as teamleader,ctf_users.email as teamleaderemail, pending_invite.team_id FROM pending_invite 
                JOIN teams ON pending_invite.team_id = teams.team_id
                JOIN ctf_users ON teams.teamleader_id = ctf_users.id
                WHERE pending_invite.user_email = ?
                LIMIT 1";
        $res = prepared_query($conn, $sql, [$useremail], "s");
        $cursor = iimysqli_stmt_get_result($res);
        
        $row = iimysqli_result_fetch_assoc_array($cursor);
        if (!$row)
            return false;
        mysqli_stmt_close($res);
        $members = getGroupMembers($conn, $row['team_id']);
        $row['members'] = $members;
        return $row;
    }
    
    $invite = getPendingInvite($conn, $useremail);
