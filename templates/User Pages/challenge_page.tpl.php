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
    <div id = "header">
        <div id = "socialMedia">
            <a href="https://www.instagram.com/rv.ctf/"><img src="static/images/instagram.png" id="IG_logo"></a>
            <a href="https://discord.gg/uagKpY6c"><img src="static/images/discord.png" id="discord_logo"></a>
        </div>
        <a href = "index.php?filename=leaderboard" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>
        <div id = "links">
            <div id="chals_header" class = "linkEle">Challenges</div> 
            <div class = "linkEle" style = 'font-family: arial;'>|</div> 
            <div id="res_header" class = "linkEle"><a href="index.php?filename=resources" class="res_header_link">Resources</a></div>
            <div class = "linkEle" style = 'font-family: arial;'>|</div> 
            <div class="linkEle"><a class = "res_header_link" href = "index.php?filename=logout">logout</a></div>
            <div class = "linkEle">Points: <?php echo $points ?></div>
        </div>
    </div>
    
    <?php foreach ($challenges as $key => $lstofvalues){ ?>
        <h1 class="topic_header" ><?php echo $key; ?></h1>
        <div class = "challange_container" id =  "<?php echo $key; ?>">
        <?php foreach ($lstofvalues as $value){ ?>
        <button class="challenge_btn" data-desc = "<?php echo $value[6]; ?>" 
                                    data-title = "<?php echo $value[1]; ?>" 
                                    data-id = "<?php echo $value[0]; ?>" 
                                    data-cat = "<?php echo $value[5]; ?>" 
                                    data-completed = <?php echo $value[7]; ?>>
            <table class="challenge_widget" data-completed = <?php echo $value[7]; ?>>
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name"><?php echo $value[1]; ?></td></tr>
                    <tr class="points_div"><td class="points"><?php echo $value[4]; ?> points | <?php echo $difficultylst[$value[3]]; ?> </td></tr>
                    <tr class="author_div"><td class="author"><?php echo $value[2];?></td></tr>
                </tbody>
            </table>
        </button>        
        <?php }?>
        </div>
    <?php
    }?>
     <div class="popup" id = "popup">
            <table class="popup_content">
                <tr class="popup_header_tr">
                    <td class="popup_header"><span id = "title_popup"></span><span class="close" id = "close">&times;</span> 
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){?>
                        <form onsubmit="deleteChallenge(this, event)" style = 'display: inline;'>
                            <input type="hidden" name="id" class = 'challengeID'>
                            <input type="hidden" name="cat" id = 'challengeCat'>
                            <button type="submit" style = "background-color: rgb(0,0,0,0); width: 1.5rem;border:none;"><img src="static/images/trash.png" alt="Delete" style = 'width:1.5rem;'></button>
                        </form>
                    <?php }; ?></td>
                </tr>
                <tr class="popup_desc_tr">
                    <td class="popup_desc"><div id = "desc_popup" style = 'overflow: scroll;height: 10ch;display:block;'></div></td>
                </tr>
                <tr class="popup_input_tr">
                    <td class="popup_input" id = "popup_input_uncompleted" style = 'display: none;'>
                    <form onsubmit = "submitAnswer(this,event)">
                        <input type="hidden" name="id" class = 'challengeID'>
                        Input Flag: <input class="flag_input" id="flag_input_test" type="text" name = "answer" placeholder="RVCTF{flag}">
                    </form>
                    </td>
                    <td class="popup_input" id = "popup_input_completed" style = 'display: none;'>
                        Completed
                    </td>
                </tr>
            </table>
        </div>
    <?php if (isset($_SESSION['admin'])){if($_SESSION['admin']){ ?>
    <button class='add_chal_btn' id="add_chal" onclick="addChal()">+</button>
    <form onsubmit = "submitChallenge(this,event)">
    <div id="add_chal_box">
            <table class="add_chal_content">
                <tr class="add_chal_tr" id="add_chal_title_tr">
                    <td class="add_chal_td">Title:</td>
                    <td class="add_chal_td_input"><input name = "title" class="add_chal_input" id="add_chal_title" type="text" placeholder="What is it called?"><span id="add_chal_close">&times;</span></td>
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
                    <td class="add_chal_td_input">
                        <textarea name = "desc" class="add_chal_input" id="add_chal_desc" type="text" placeholder = "Description to be shown to members" cols="30" rows="10"></textarea>
                    </td>
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