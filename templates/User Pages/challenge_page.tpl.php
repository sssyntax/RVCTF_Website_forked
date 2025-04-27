<?php
require_once "backend/includes/connect.inc.php";

// Fetch CTF timing info
$sql = "SELECT start_time, end_time FROM ctf_config WHERE id = 1";
$result = mysqli_query($conn, $sql);
$ctf_config = mysqli_fetch_assoc($result);

$now = time();
$start_time = $ctf_config['start_time'];
$end_time = $ctf_config['end_time'];

$ctf_not_started = $now < $start_time;
$ctf_ended = $now > $end_time;
$ctf_running = !$ctf_not_started && !$ctf_ended;

// Casual Mode (4h window active)
$casual_mode = (($end_time - $start_time) <= 14400);

// Calculate time left if needed
$time_left = max(0, $end_time - $now);
?>

<title>Challenges</title>
<link rel="stylesheet" href="static/css/challenge.css">
<style>
#ctf-timer {
    font-family: 'VT323', monospace;
    font-size: 3rem;
    color: #9ee7ff;
    text-align: center;
    margin-top: 10px;
}
.ctf-message {
    font-family: 'Montserrat', sans-serif;
    font-size: 2.8rem;
    color: #9ee7ff;
    text-align: center;
    height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    animation: pulse 2s infinite;
    text-shadow: 0 0 10px #00c3ff, 0 0 20px #00c3ff, 0 0 30px #00c3ff;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.6; }
    100% { opacity: 1; }
}

</style>
</head>

<body>

<?php if ($ctf_not_started): ?>
    <div class="ctf-message">🚀 CTF has not started yet. Stay tuned! 🚀</div>

<?php elseif ($ctf_ended): ?>
    <div class="ctf-message">🏁 CTF has ended! Thank you for participating. 🏁</div>

<?php elseif ($ctf_running): ?>

    <?php if (!$casual_mode): ?>
    <!-- Timer only shows if real CTF running (not casual mode) -->
    <div id="ctf-timer">
        Time Remaining: <span id="timer-countdown"></span>
    </div>

    <script>
        let timeLeft = <?= $time_left; ?>;
        const timerElement = document.getElementById('timer-countdown');

        function updateTimer() {
            let hours = Math.floor(timeLeft / 3600);
            let minutes = Math.floor((timeLeft % 3600) / 60);
            let seconds = timeLeft % 60;

            timerElement.innerText = `${hours}h ${minutes}m ${seconds}s`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                timerElement.innerText = "CTF is over!";
                location.reload();
            }
        }

        updateTimer();
    </script>
    <?php endif; ?>

    <?php
    include ('backend/challenge.php');
    include ('backend/createChallengeButton.php');
    ?>

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

<?php endif; ?>

</body>
</html>
