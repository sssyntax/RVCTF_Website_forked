<title>Challenges</title>
<link rel="stylesheet" href="static/css/challenge.css">
</head>

<body>
    <?php include ('backend/challenge.php'); ?>
    <?php include ('backend/createChallengeButton.php'); ?>
    <?php foreach ($challenges as $key => $lstofvalues) { ?>
        <h1 class="topic_header"><?php echo $key; ?></h1>
        <div class="challange_container" id="<?php echo $key; ?>">
            <?php foreach ($lstofvalues as $value) { ?>
                <?= createChallengeButton($value, $difficultylst); ?>
            <?php } ?>
        </div>
        <?php
    } ?>
    <?php include 'templates/Components/challenge_popup.tpl.php'; ?>
    <script src="static/js/challenge.js" defer></script>
</body>

</html>