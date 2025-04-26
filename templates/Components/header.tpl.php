<?php 
$pages = array("resources", "leaderboard", "team");

// Dynamic points pull from DB
$query = "SELECT SUM(points) as total_points
          FROM completedchallenges cc
          JOIN challenges c ON cc.challenge_id = c.id
          WHERE cc.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$realPoints = $row['total_points'] ?? 0;
?>

<div id='header-container'>
    <div id='header-social-media'>
        <a href="https://www.instagram.com/rv.ctf/" target="_blank">
            <img src="static/images/instagram.png">
        </a>
        <a href="https://discord.gg/XPs8DZvt" target="_blank">
            <img src="static/images/discord.png">
        </a>
    </div>

    <!-- Always logo back to challenges -->
    <a href="index.php?filename=challenges" style="text-align: center;">
        <img src="static/images/RVCTF Neon Logo.png" id="cca_name">
    </a>

    <table id='links'>
        <tr>
            <td>
                <?php if (in_array($filename, $pages)) { ?>
                    <a href="index.php?filename=challenges" class="header_link">Challenges</a>
                <?php } else { ?>
                    <span id='current-page'>Challenges</span>
                <?php } ?>
            </td>

            <td>
                <?php if ($filename != "leaderboard") { ?>
                    <a href="index.php?filename=leaderboard" class="header_link">Leaderboard</a>
                <?php } else { ?>
                    <span id='current-page'>Leaderboard</span>
                <?php } ?>
            </td>
        </tr>

        <tr>
            <td>
                <?php if ($filename != "team") { ?>
                    <a href="index.php?filename=team" class="header_link">Team</a>
                <?php } else { ?>
                    <span id='current-page'>Team</span>
                <?php } ?>
            </td>

            <td>
                <a class="header_link" href="index.php?filename=logout">Logout</a>
            </td>
        </tr>

        <tr>
            <td colspan="2" style="text-align: center;">
                My Points: <span id="points"><?php echo $realPoints; ?></span>
            </td>
        </tr>
    </table>
</div>
