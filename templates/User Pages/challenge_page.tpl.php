<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenges</title>
    <link rel="stylesheet" href="static/css/challenge.css">
</head>
<body>
    <?php include 'templates/stars.php';?>
    <div id = "header">
        <div id = "socialMedia">
            <a href="https://www.instagram.com/rv.ctf/"><img src="static/images/instagram.png" id="IG_logo"></a>
            <a href="https://discord.gg/uagKpY6c"><img src="static/images/discord.png" id="discord_logo"></a>
        </div>
        <img src="static/images/RVCTF Neon Logo.png" id="cca_name">
        <div id = "links">
            <div id="chals_header" class = "linkEle">Challenges</div> 
            <div class = "linkEle">|</div> 
            <div id="res_header" class = "linkEle"><a href="index.php?filename=resources" id="res_header_link">Resources</a></div>
            <div class = "linkEle">|</div> 
            <div class = "linkEle">Points: <?php echo $points ?></div>
        </div>
    </div>
    
    <?php foreach ($challenges as $key => $lstofvalues){ ?>
        <h1 class="topic_header" ><?php echo $key; ?></h1>
        <div class = "challange_container" id =  "<?php echo $key; ?>">
        <?php foreach ($lstofvalues as $value){ ?>
        <button class="challenge_btn" data-desc = "<?php echo $value['description']; ?>" data-title = "<?php echo $value['title']; ?>">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name"><?php echo $value['title']; ?></td></tr>
                    <tr class="points_div"><td class="points"><?php echo $value['points']; ?> points | <?php echo $difficultylst[$value['difficulty']]; ?> </td></tr>
                    <tr class="author_div"><td class="author"><?php echo $value['author']; ?></td></tr>
                </tbody>
            </table>
        </button>
       
        <?php }?>
        </div>
    <?php
    }?>
     <div class="popup" id = "popup">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header"><span id = "title_popup"></span><span class="close" id = "close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc"><span id = "desc_popup"></span></td></tr>
                <tr class="popup_input_tr"><td class="popup_input">
                    <form onsubmit = "submitAnswer(this,event)">
                        Input Flag: <input class="flag_input" id="flag_input_test" type="text" name = "answer" placeholder="RVCTF{flag}">
                    </form>
                </td></tr>
            </table>
        </div>
    <!-- <h1 class="topic_header">Forensics</h1>
    <div class="challenge_container" id="forensics">
        <button class="challenge_btn">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1 Lorem ipsum dolor sit dadadad</td></tr>
                    <tr class="points_div"><td class="points">10 points | Easy</td></tr>
                    <tr class="author_div"><td class="author">CommunistChiken</td></tr>
                </tbody>
            </table>
        </button>
        <div class="popup">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">Challenge 1<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">The following file has been corrupted! Help me find the flag</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">
                    <form action="challenge.php">
                        Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}">
                    </form>
                </td></tr>
            </table>
        </div>

        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 2</td></tr>
                    <tr class="points_div"><td class="points">50 points | Medium</td></tr>
                    <tr class="author_div"><td class="author">CommunistChiken</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">Challenge 2<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">I managed to capture a pcap file from my neighbour's wifi router. Help me find out what he has been doing!</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    <h1 class="topic_header">Cryptography</h1>
    <div class="challenge_container" id="crypto">
        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1</td></tr>
                    <tr class="points_div"><td class="points">20 points | Easy</td></tr>
                    <tr class="author_div"><td class="author">RVCTF ExCo</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">Challenge 1<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">HHFCSNDCJNOSWIDJIOWYHUEIGWIDNJWIDHNIUWGDUIDBA</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    <h1 class="topic_header">Web Exploit</h1>
    <div class="challenge_container" id="web">
        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1</td></tr>
                    <tr class="points_div"><td class="points">100 points | Hard</td></tr>
                    <tr class="author_div"><td class="author">RVCTF ExCo</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">Challenge 1<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">Hack into the following website, and steal the flag</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    <h1 class="topic_header">Reverse Engineering</h1>
    <div class="challenge_container" id="re">
        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1</td></tr>
                    <tr class="points_div"><td class="points">100 points | Hard</td></tr>
                    <tr class="author_div"><td class="author">CommunistChiken</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">Challenge 1<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">This file has been encrypted! But I've managed to obtain the encryption programme file. Help me obtain the original text!</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    <h1 class="topic_header">PWN</h1>
    <div class="challenge_container" id="pwn">
        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1</td></tr>
                    <tr class="points_div"><td class="points">50 points | Medium</td></tr>
                    <tr class="author_div"><td class="author">RVCTF ExCo</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">CHALLENGE NAME<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">CHALLENGE DESCRIPTIONS</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    <h1 class="topic_header">OSINT</h1>
    <div class="challenge_container" id="osint">
        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 1</td></tr>
                    <tr class="points_div"><td class="points">20 points | Easy</td></tr>
                    <tr class="author_div"><td class="author">RVCTF ExCo</td></tr>
                </tbody>
                
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">CHALLENGE NAME<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">CHALLENGE DESCRIPTIONS</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>

        <button class="challenge_btn" id="chal_btn_test">
            <table class="challenge_widget">
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name">Challenge 2</td></tr>
                    <tr class="points_div"><td class="points">60 points | Medium</td></tr>
                    <tr class="author_div"><td class="author">CommunistChiken</td></tr>
                </tbody>
            </table>
        </button>
        <div class="popup" id="popup_test">
            <table class="popup_content">
                <tr class="popup_header_tr"><td class="popup_header">CHALLENGE NAME<span class="close">&times;</span></td></tr>
                <tr class="popup_desc_tr"><td class="popup_desc">CHALLENGE DESCRIPTIONS</td></tr>
                <tr class="popup_input_tr"><td class="popup_input">Input Flag: <input class="flag_input" id="flag_input_test" type="text" placeholder="RVCTF{flag}"></td></tr>
            </table>
        </div>
    </div>
    -->
    <?php if (isset($_SESSION['admin'])){if($_SESSION['admin']){ ?>
    <button class='add_chal_btn' id="add_chal" onclick="addChal()">+</button>
    <form onsubmit = "submitChallenge(this,event)">
    <div id="add_chal_box">
            <table class="add_chal_content">
                <tr class="add_chal_tr" id="add_chal_title_tr">
                    <td class="add_chal_td">Title:</td>
                    <td class="add_chal_td_input"><input name = "title" class="add_chal_input" id="add_chal_title" type="text" placeholder="What is it called?"><span id="add_chal_close">&times;</td>
                    </tr>
                <tr class="add_chal_tr" id="add_chal_author_tr">
                    <td class="add_chal_td">Author:</td>
                    <td class="add_chal_td_input"><input name = "author" class="add_chal_input" id="add_chal_author" type="text" placeholder="Who did this?"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_points_tr">
                    <td class="add_chal_td">Points:</td>
                    <td class="add_chal_td_input"><input name = "points" class="add_chal_input" id="add_chal_points" type="number" min="0" placeholder="How many points to be awarded?"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_difficulty_tr">
                    <td class="add_chal_td">Difficulty:</td>
                    <td class="add_chal_td_input">
                        <select class="add_chal_input" id="add_chal_difficulty" name = "difficulty">
                            <option value="0">Easy</option>
                            <option value="1">Medium</option>
                            <option value="2">Hard</option>
                        </select>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_cat_tr">
                    <td class="add_chal_td">Category:</td>
                    <td class="add_chal_td_input">
                        <select class="add_chal_input" id="add_chal_cat" name = "category">
                            <option value="Forensics">Forensics</option>
                            <option value="Crypto">Cryptography</option>
                            <option value="Web">Web Exploit</option>
                            <option value="Reverse Engineering">Reverse Engineering</option>
                            <option value="PWN">PWN</option>
                            <option value="OSINT">OSINT</option>
                        </select>
                    </td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_desc_tr">
                    <td class="add_chal_td">Description:</td>
                    <td class="add_chal_td_input"><input name = "desc" class="add_chal_input" id="add_chal_desc" type="text" placeholder="Description to be shown to members"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_link_tr">
                    <td class="add_chal_td">Solution:</td>
                    <td class="add_chal_td_input"><input name = "solution" class="add_chal_input" id="add_chal_link" type="text" placeholder="Solution"></td>
                </tr>
                <tr class="add_chal_tr" id="add_chal_link_tr">
                    <td class="add_chal_td"><input type = "submit" id="add_chal_submit_btn" value = "Submit"></td>
                </tr>
            </table>
        
    </div> 
    </form>
    <?php }}?>
    
    <script src="static/js/challenge.js"></script>
</body>
</html>