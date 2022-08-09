<?php
require "includes/connect.inc.php";
$challenges = [];
$difficultylst = ["Easy","Medium","Hard"];
$sql = "SELECT * FROM `challenges`";
$res = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($res)){
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

$sql = "SELECT `points` FROM `users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$_SESSION['userID']],"i");
$res -> bind_result($points);
$res -> fetch();
mysqli_stmt_close($res);
?>