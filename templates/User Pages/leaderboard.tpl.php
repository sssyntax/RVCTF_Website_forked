<title>Leaderboard</title>
<link rel='stylesheet' href='static/css/leaderboard.css'>
</head>

<body>
  <?php include 'backend/leaderboard.php'?>
  <?php include 'templates/Components/stars.php';?>

  <h2 id="team-ranks-header">Team Ranks</h2>
  <table class="table team">
    <tr>
      <td>
        <ul class="leader">
          <?php 
          $index = 1;
          foreach($teams as $team){ ?>
            <li id=
            <?php if ($index == 1) {
              echo "decoration";
            } else if ($index == 2) {
              echo "decoration2";
            } else if ($index == 3) {
              echo "decoration3";
            } ?>>
              <span class='list_num'><?php echo $index; ?></span>
              <h2>
                <?php 
                echo $team['team_name']; ?>
                <span class="number">
                  <?php echo $team['points']; ?>
                </span>
              </h2>
            </li>
          <?php $index++; } ?>
        </ul>
      </td>
    </tr>
  </table>

  <h2 id="individual-ranks-header">Individual Ranks</h2>
  <table class="table individual">
    <tr>
      <td>
        <ul class="leader">
          <?php 
          $index = 1;
          foreach($users as $user){ ?>
            <li id=
            <?php if ($index == 1) {
              echo "decoration";
            } else if ($index == 2) {
              echo "decoration2";
            } else if ($index == 3) {
              echo "decoration3";
            } ?>>
              <span class='list_num'><?php echo $index; ?></span>
              <h2>
                <?php 
                echo $user['username']; ?> (<?= $user['team_name'] ?>)
                <span class="number">
                  <?php echo $user['points']; ?>
                </span>
              </h2>
            </li>
          <?php $index++; } ?>
        </ul>
      </td>
    </tr>
  </table>

</body>
</html>
