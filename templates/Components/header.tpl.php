<?php 
$pages = array("resources", "leaderboard", "team");

// Dynamic points pull from DB (with double points + admin points + first blood bonuses)
$sql = "
    SELECT 
        COALESCE(SUM(
            CASE 
                WHEN c.double_points = 1 THEN c.points * 2
                ELSE c.points
            END
        ), 0) AS challenge_points,
        COALESCE(SUM(a.points), 0) AS admin_points
    FROM completedchallenges cc
    JOIN challenges c ON cc.challenge_id = c.id
    LEFT JOIN admin_points a ON a.user_id = cc.user_id
    WHERE cc.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($challengePoints, $adminPoints);
$stmt->fetch();
$stmt->close();

// Get sum of first blood bonuses (only once per challenge, if user was first)
$sql_bonus = "SELECT COALESCE(SUM(c.first_blood_bonus), 0)
              FROM challenges c
              JOIN completedchallenges cc ON cc.challenge_id = c.id
              WHERE cc.user_id = ?
              AND cc.timestamp = (
                  SELECT MIN(cc2.timestamp)
                  FROM completedchallenges cc2
                  WHERE cc2.challenge_id = c.id
              )";
$stmt_bonus = $conn->prepare($sql_bonus);
$stmt_bonus->bind_param("i", $userid);
$stmt_bonus->execute();
$stmt_bonus->bind_result($firstBloodBonus);
$stmt_bonus->fetch();
$stmt_bonus->close();

// Final total
$realPoints = ($challengePoints ?: 0) + ($adminPoints ?: 0) + ($firstBloodBonus ?: 0);
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
