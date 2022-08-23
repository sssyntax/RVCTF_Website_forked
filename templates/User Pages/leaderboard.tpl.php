<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel='stylesheet' href='static/css/leaderboard.css'>
</head>

<body>
    <?php include 'templates/stars.php';?>
    <a href="https://www.instagram.com/rv.ctf/"><img src="static/images/instagram.png" id="IG_logo"></a>
    <a href="https://discord.gg/uagKpY6c"><img src="static/images/discord.png" id="discord_logo"></a>
    <a href = "index.php?filename=challenge" style= 'text-align: center;'><img src="static/images/RVCTF Neon Logo.png" id="cca_name"></a>

    <div class="table">
        <div class="table-cell">
            <ul class="leader">
                <?php 
                $index = 1;
                foreach($users as $user){ ?>
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
                        echo substr($user['email'], 0, strpos($user['email'], "@")); ?>
                        <span class="number">
                          <?php echo $user['points']; ?>
                        </span>
                      </h2>
                  </li>
                <?php $index++;}?>
    </ul>
  </div>
</div>
</body>
</html>