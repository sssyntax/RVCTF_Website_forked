    <title>Leaderboard</title>
    <link rel='stylesheet' href='static/css/leaderboard.css'>
</head>

<body>
<?php include 'templates/Components/stars.php';?>

      <table class="table">
        <tr>
          <td>
            <ul class="leader">
                  <?php 
                  $index = 1;
                  foreach($teams as $team){ ?>
                    <li id = 
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
                          // Only get the front part of the email as username
                          echo $team['teamname']; ?>
                          <span class="number">
                            <?php echo $team['points']; ?>
                          </span>
                        </h2>
                    </li>
                  <?php $index++;}?>
            </ul>
          </td>
        </tr>
      </table>

</body>
</html>