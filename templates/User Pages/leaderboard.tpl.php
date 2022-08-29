<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel='stylesheet' href='static/css/leaderboard.css'>
</head>

<body>

    <div class="table">
        <div class="table-cell">
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
  </div>
</div>
</body>
</html>