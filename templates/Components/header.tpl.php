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
            <?php if($filename == "resources" || $filename == "leaderboard") {?>
                    <a href="index.php?filename=challenges" class="header_link">Challenges</a>
                <?php } else {?>
                    <span id = 'current-page'>Challenges</span>
                <?php } ?>
            </td>
            <td>
                <?php if($filename != "resources") {?>
                    <a href="index.php?filename=resources" class="header_link">Resources</a>
                <?php } else {?>
                    <span id = 'current-page'>Resources</span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>
                <a class = "header_link" href = "index.php?filename=logout">Logout</a>
            </td>
            <td>
                Points: <?php if(isset($_SESSION['points'])) {echo $_SESSION['points'];} else {echo "internal error";} ?>
            </td>
        </tr>
    </table>
</div>