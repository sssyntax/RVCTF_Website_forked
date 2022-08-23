<?php
require "includes/connect.inc.php";
$userid = $_SESSION['userID'];
$challenges = [];
$difficultylst = ["Easy","Medium","Hard"];
// Only select certain fields & check if the challenge has been completed by the user before
$sql = "SELECT `id`, `title`, `author`, `points`, `difficulty`, `category`, `description`, `userid` FROM `challenges` LEFT JOIN `completedchallenges` ON `challenges`.`id` = `completedchallenges`.`challengeid` WHERE `userid` IS NULL OR `userid` = ?;";
$res = prepared_query($conn, $sql, [$userid], "i");
try {
    // Check if binding was successful
    $result = $res->get_result();
    while ($row = mysqli_fetch_assoc($result)){
        if (array_key_exists($row['category'],$challenges)){
            array_push($challenges[$row['category']],$row);
        }
        else{
            $challenges[$row['category']]=[$row];
        }
    }
    foreach ($challenges as $key => $array){
        usort($array,function($a,$b){if ($a['difficulty']-$b['difficulty'] == 0){
            return $a['points']-$b['points'];
        }
        else{
            return $a['difficulty']-$b['difficulty'];
        }
        
    });
    $challenges[$key] = $array;
    }
    
}
catch(Exception $e) {
    echo $e;
}
mysqli_stmt_close($res);
$sql = "SELECT `points` FROM `users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$_SESSION['userID']],"i");
try {
    // Check if result failed
    $res -> bind_result($points);
    $res -> fetch();
    mysqli_stmt_close($res);
}
catch(Exception $e) {
    echo $e;
    $points = 0; 
}
?>