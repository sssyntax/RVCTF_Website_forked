<?php $pages = array( "resources", "leaderboard", "team"); ?>
<div id = 'header-container'>
    <div id = 'header-social-media'>
        <a href="https://www.instagram.com/rv.ctf/" target="_blank"><img src="static/images/instagram.png"></a>
        <a href="https://discord.gg/XPs8DZvt" target="_blank"><img src="static/images/discord.png"></a>
    </div>
    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1 && $filename != "leaderboard") {?>
        <a href = "index.php?filename=leaderboard" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>
    <?php } else {?> 
        <a href = "index.php?filename=challenge" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>
    <?php } ?>
    <table id = 'links'>
        <tr>
            <td>
            <?php if(in_array($filename,$pages)) {?>
                    <a href="index.php?filename=challenges" class="header_link">Challenges</a>
                <?php } else {?>
                    <span id = 'current-page'>Challenges</span>
                <?php } ?>
            </td>
            
            <!-- <td>
                <?php if($filename != "resources") {?>
                    <a href="index.php?filename=resources" class="header_link">Resources</a>
                <?php } else {?>
                    <span id = 'current-page'>Resources</span>
                <?php } ?>
            </td> -->
            <td>
                <?php if($filename != "leaderboard") {?>
                    <a href="index.php?filename=leaderboard" class="header_link">Leaderboard</a>
                <?php } else {?>
                    <span id = 'current-page'>Leaderboard</span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php if($filename != "team") {?>
                    <a href="index.php?filename=team" class="header_link">Team</a>
                <?php } else {?>
                    <span id = 'current-page'>Team</span>
                <?php } ?>
            </td>
            <td>
                <a class = "header_link" href = "index.php?filename=logout">Logout</a>
            </td>
        </tr>
        <tr>
            
            <td colspan = 2>
                My Points: <span id = "points"><?php echo $points?></span>
            </td>
        </tr>
    </table>
</div>