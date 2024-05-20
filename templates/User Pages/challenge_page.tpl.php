    <title>Challenges</title>
    <link rel="stylesheet" href="static/css/challenge.css">
</head>
<body data-admin = <?php echo $_SESSION['admin']; ?>>
<?php include 'templates/Components/stars.php';?>
    <?php if (isset($_SESSION['admin'])){if($_SESSION['admin']){?>
        <button class="editadmin" onclick="location.href='index.php?filename=editadmin'">Add admin</button>
    <?php
    }}?>
    <?php foreach ($challenges as $key => $lstofvalues){ ?>
        <h1 class="topic_header" ><?php echo $key; ?></h1>
        <div class = "challange_container" id =  "<?php echo $key; ?>">
        <?php foreach ($lstofvalues as $value){ ?>
        <button class="challenge_btn" 
        data-desc = "<?= htmlspecialchars($value[6]); ?>" 
                                    data-title = "<?= htmlspecialchars($value[1]); ?>" 
                                    data-id = "<?= htmlspecialchars($value[0]) ?>" 
                                    data-cat = "<?= htmlspecialchars($value[5]) ?>" 
                                    data-completed = <?= htmlspecialchars($value[8]) ?>
                                    data-author = <?= htmlspecialchars($value[2]); ?>>
            <table class="challenge_widget" data-completed = <?php echo $value[8]; ?>>
                <tbody class="widget_body">
                    <tr class="name_div"><td class="name"><?php echo $value[1]; ?></td></tr>
                    <tr class="points_div"><td class="points"><?php echo $value[4]; ?> points | <?php echo $difficultylst[$value[3]]; ?> </td></tr>
                    <tr class="solved_by_div"><td class="solved_by">Solved By <?php echo $value[7]??0;?></td></tr>
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
                    <td class="popup_header">
                        <span id = "title_popup">

                        </span>
                        <span class="close" id = "close">&times;</span> 
                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1){?>
                        <form onsubmit="deleteChallenge(this, event)" style = 'display: inline;'>
                            <input type="hidden" name="id" class = 'challengeID'>
                            <button class = "delete" type="submit"><img src="static/images/trash.png" alt="Delete" style = 'width:1.5rem;'></button>
                        </form>
                    <?php }; ?>
                        <br>
                        <span style = "font-size:0.8em;font-weight:normal;">Solved By <span id = "solved_count"></span></span>
                </td>
                </tr>
                <tr class="popup_desc_tr">
                    <td class="popup_desc">
                        <div id = "desc_popup" style = 'overflow: scroll;height: 20ch;display:block;'>
                        
                        </div>
                        <div>
                            Author: <span id = "author_popup"></span>
                        </div>
                    </td>
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
    <script src="static/js/challenge.js" defer></script>
</body>
</html>