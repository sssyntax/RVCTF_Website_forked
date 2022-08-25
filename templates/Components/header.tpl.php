<style>
@font-face {
    font-family: header_font;
    src: url(../fonts/VT323-Regular.ttf);
}
#header-container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    font-family: header_font;
    color: rgb(210, 210, 210)
}
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

#header-links {
    display: grid;
    grid-template-columns: 2fr 1fr 2fr;
    font-size: 1.5rem;
    align-items: center;
}

.linkEle {
    text-decoration:none;
    font-size: 1.5rem;
}
</style>

<div id = 'header-container'>
    <div id = 'header-social-media'>
        <a href="https://www.instagram.com/rv.ctf/"><img src="static/images/instagram.png"></a>
        <a href="https://discord.gg/uagKpY6c"><img src="static/images/discord.png"></a>
    </div>
    <a href = "index.php?filename=leaderboard" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>
    <div id = 'header-links'>
        <div id="chals_header" class = "linkEle">Challenges</div> 
        <div>|</div>
        <div ><a href="index.php?filename=resources" class="res_header_link">Resources</a></div>
        <div class="linkEle"><a class = "res_header_link" href = "index.php?filename=logout">logout</a></div>
        <div>|</div>
        <div class="linkEle">Points: <?php if(isset($_SESSION['points'])) {echo $_SESSION['points'];} else {echo "internal error";} ?></div>
    </div>
</div>