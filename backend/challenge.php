<?php
require_once "includes/connect.inc.php";
require_once "includes/getinfo.inc.php";
$userid = $_SESSION['userid'];
// Challenges is an associative array (like dicitonary)
$challenges = [];
$completed = [];
$difficultylst = ["Easy","Medium","Hard"];
// Get challenges completed by the user
$sql = "SELECT `challengeid` FROM `completedchallenges` where `userid` = ?;";
$res = prepared_query($conn, $sql, [$userid], "i");
// Get result of the query (like csv module in python) 
$result = iimysqli_stmt_get_result($res);
// Iterate through all the rows in the result (binded to $row)
while ($row = iimysqli_result_fetch_array($result)){
    array_push($completed, $row[0]); 
}
mysqli_stmt_close($res);
// Get all challenges in the database
$sql = "SELECT `id`, `title`, `author`, `difficulty`, `points`, `category`, `description`,`solve_count` FROM 
        `challenges` 
        LEFT JOIN (
            SELECT `challengeid`, COUNT(*) as `solve_count` FROM `completedchallenges` GROUP BY `challengeid`
        ) as `solved` ON `challenges`.`id` = `solved`.`challengeid`
        ORDER BY `category`, `difficulty` ASC, `solve_count` DESC;";
$res = mysqli_query($conn, $sql); 
try {
    // Iterate through all the challenges
    // Upon reaching the end, $row == Null and the loop is terminated
    while ($row = mysqli_fetch_row($res)){
        // Check if challenge has been completed
        if (in_array($row[0], $completed)) {
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

}
}
catch(Exception $e) {
    echo $e;
}

?>