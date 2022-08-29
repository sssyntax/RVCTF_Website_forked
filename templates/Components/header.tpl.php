<style>
@font-face {
    font-family: header_font;
    src: url(static/fonts/VT323-Regular.ttf);
}
/* Css for overall header */
#header-container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    font-family: header_font;
    color: rgb(210, 210, 210)
}

/* CSS for social media */
#header-social-media {
    display: flex;
    gap: 5%;
    align-items: center;
    justify-content: center;
}

#header-social-media a {
    text-align: center;
    width: 40%;
}
#header-social-media a img {
    width: 40%;
}

/* CSS for CTF logo link */
#cca_name {
    width: 60%;
}

/* CSS for links */
#current-page {
    text-decoration: underline;
}

#links {
    border-collapse: collapse;
    border-style: hidden;
}

#links td {
    font-size: 1.5rem;
    text-decoration: none;
    padding: 0.5rem;
    border: 3px solid rgb(210, 210, 210);
    color: rgb(210, 210, 210);
    text-align: center;
}

.header_link {
    text-decoration: none;
    color: rgb(210, 210, 210);
}

</style>

<div id = 'header-container'>
    <div id = 'header-social-media'>
        <a href="https://www.instagram.com/rv.ctf/"><img src="static/images/instagram.png"></a>
        <a href="https://discord.gg/uagKpY6c"><img src="static/images/discord.png"></a>
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
                <a class = "header_link" href = "index.php?filename=logout">logout</a>
            </td>
            <td>
                Points: <?php if(isset($_SESSION['points'])) {echo $_SESSION['points'];} else {echo "internal error";} ?>
            </td>
        </tr>
    </table>
</div>