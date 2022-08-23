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
    $result = iimysqli_stmt_get_result($res);
    while ($row = iimysqli_result_fetch_array($result)){
        if (array_key_exists($row[5],$challenges)){
            array_push($challenges[$row[5]],$row);
        }
        else{
            $challenges[$row[5]]=[$row];
        }
    }
    foreach ($challenges as $key => $array){
        usort($array,function($a,$b){if ($a[4]-$b[4] == 0){
            return $a[3]-$b[3];
        }
        else{
            return $a[4]-$b[4];
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