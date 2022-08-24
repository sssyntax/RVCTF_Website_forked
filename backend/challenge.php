<?php
require "includes/connect.inc.php";
$userid = $_SESSION['userID'];
// Challenges is an associative array (like dicitonary)
$challenges = [];
$completed = [];
$difficultylst = ["Easy","Medium","Hard"];
// Get challenges completed by the user
$sql = "SELECT * FROM `completedchallenges` where `userid` = ?;";
$res = prepared_query($conn, $sql, [$userid], "i");
// Get result of the query (like csv module in python) 
$result = iimysqli_stmt_get_result($res);
// Iterate through all the rows in the result (binded to $row)
while ($row = iimysqli_result_fetch_array($result)){
    array_push($completed, $row); 
}
mysqli_stmt_close($res);
// Get all challenges in the database
$sql = "SELECT `id`, `title`, `author`, `difficulty`, `points`, `category`, `description` FROM `challenges` ORDER BY `category`; ";
$res = mysqli_query($conn, $sql); 
// $res = prepared_query($conn, $sql, [], "");

try {
    // Check if binding was successful
    // $result = iimysqli_stmt_get_result($res);
    // Iterate through all the challenges
    // Upon reaching the end, $row == Null and the loop is terminated
    while ($row = mysqli_fetch_row($res)){
        // Check if challenge has been completed
        if (in_array($row, $completed)) {
            // Flag the challenge as completed
            array_push($row, 1);
        }
        else {
            // Flag the challenge as not completed
            array_push($row, 0);
        }
        // Add the challenge to the list of challenges
        // Check if the key for the category already exists
        if (array_key_exists($row[5],$challenges)){
            // Add the challenge to the array corresponding to the category
            array_push($challenges[$row[5]],$row);}
        // The category does not have a key associated with it in the challenges associative array
        else{
            // Define a new key value pair in the challenges associative array
            $challenges[$row[5]]=[$row];
    }
    // Rank challenges by difficulty, then points
    // Iterate through each category in the challenges associative array
    foreach ($challenges as $key => $array){
        // Sort each category using a custom comparison function
        // result stored in $array variable
        usort($array,function($a,$b){
            // If the difficulty of the 2 challenges are the same
            if ($a[4]-$b[4] == 0){
                // return the difference in points 
                return $a[3]-$b[3];
            }
            else{
                // return the difference in difficulty 
                return $a[4]-$b[4];
            }
        });
    // update the challenges array with the sorted category array
    $challenges[$key] = $array;
    }
}
}
catch(Exception $e) {
    echo $e;
}

// Get the users current number of points
$sql = "SELECT `points` FROM `ctf_users` WHERE `id` = ?";
$res = prepared_query($conn,$sql,[$_SESSION['userID']],"i");
try {
    // Check if result failed
    $res -> bind_result($points);
    $res -> fetch();
    $_SESSION['points'] = $points;
}
catch(Exception $e) {
    echo $e;
    $points = 0; 
}
mysqli_stmt_close($res);
?>