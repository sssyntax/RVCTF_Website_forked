<?php
require_once "backend/ctf_timer.inc.php";
$ctfStatus = getCTFStatus($conn);
?>

<title>Challenges</title>
<link rel="stylesheet" href="static/css/challenge.css">
<style>
/* Inject custom timer font styling */
#ctf-timer {
    font-family: 'VT323', monospace; /* match challenge font */
    font-size: 3rem; /* make it nicely big */
    color: #9ee7ff;
    text-align: center;
    margin-top: 10px;
}
</style>
</head>

<body>
    <div id="ctf-timer"></div>

    <script>
        let timeLeft = <?= $ctfStatus['time_left']; ?>;
        const timerElement = document.getElementById('ctf-timer');

        function updateTimer() {
            let hours = Math.floor(timeLeft / 3600);
            let minutes = Math.floor((timeLeft % 3600) / 60);
            let seconds = timeLeft % 60;

            timerElement.innerText = `Time Left: ${hours}h ${minutes}m ${seconds}s`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                timerElement.innerText = "CTF is over!";
                location.reload();  // optional: refresh page if CTF ends
            }
        }

        updateTimer();
    </script>

    <?php include ('backend/challenge.php'); ?>
    <?php include ('backend/createChallengeButton.php'); ?>
    <?php foreach ($challenges as $key => $lstofvalues) { ?>
        <h1 class="topic_header"><?php echo $key; ?></h1>
        <div class="challange_container" id="<?php echo $key; ?>">
            <?php foreach ($lstofvalues as $value) { ?>
                <?= createChallengeButton($value, $difficultylst); ?>
            <?php } ?>
        </div>
    <?php } ?>
    <?php include 'templates/Components/challenge_popup.tpl.php'; ?>
    <script src="static/js/challenge.js" defer></script>
</body>

</html>
