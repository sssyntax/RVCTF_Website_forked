<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources</title>
    <link rel="stylesheet" href="static/css/resources.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <?php include "templates/stars.php" ?>
    <div id="header"> 
        <div>
            <a href="https://www.instagram.com/rv.ctf/" target="_blank"><img src="static/images/instagram.png" id="IG_logo"></a>
            <a href="https://discord.gg/uagKpY6c" target="_blank"><img src="static/images/discord.png" id="discord_logo"></a>
        </div>
        <a href = "index.php?filename=leaderboard" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>
        <div>
            <div id="res_header">
                <a href="index.php" class="res_header_link">Challenges</a>
            </div> 
            <div id="sep">|</div> 
            <div id="chals_header">Resources</div>
            <div id="sep">|</div> 
            <div class="linkEle"><a class = "res_header_link" href = "index.php?filename=logout">logout</a></div>
            <div id="sep"><?php if (isset($_SESSION['points'])) {echo strval($_SESSION['points'])." Points";} ?> </div>
        </div>
    </div> 
        <div class="menu">
        <input type="checkbox" id="toggle" />
        <label id="show-menu" for="toggle">
            <div class="btn">
            <i class="material-icons md-36 toggleBtn menuBtn">menu</i>
            <i class="material-icons md-36 toggleBtn closeBtn">close</i>
            </div>
            <div class="btn">
            <i>OSINT</i>
            </div>
            <div class="btn">
            <i>RE</i>
            </div>
            <div class="btn">
            <i>Forensics</i>
            </div>
            <div class="btn">
            <i>Crypto</i>
            </div>
            <div class="btn">
            <i>Web</i>
            </div>
            <div class="btn">
            <i>Pwn</i>
            </div>
            <div class="btn">
            <i><a class="resources" href="https://drive.google.com/drive/folders/1h7TLBvtO3FUws6ABGZMhaaprJHzAZnwT?usp=sharing">Sessions</a></i>
            </div>
            <div class="btn">
            <i><a class="resources" href="https://docs.google.com/document/d/18g0d88sTSAGbnnhtZWPiBtoCNZbjBsyIfgohd-2jC9U/edit?usp=sharing">Tools</a></i>
            </div>
        </label>
        </div>
        <!-- Make a div of height 100% to simluate that theres text in the middle -->
        <div style = "margin-top: 40%;display: block;"><br></div>
    </body>