<?php
// import Db functionality
require_once "includes/connect.inc.php";
// Check if user is not here illegally (its RVCTF, can never be too safe)
if (!isset($_SESSION) || $_SESSION['loggedin'] != 1) {
    // Check if user is even logged in or has a session
    header("Location: ../index.php?filename=login");
    exit();
} else if ($_SESSION['admin'] != 1) {
    // Check if user is an admin
    header("Location: ../index.php?filename=challenges");
    exit();
}
$teams = [];
$sql = "SELECT teamname, SUM(points) AS points 
    FROM ( 
        SELECT t.team_id, c.id, c.points FROM ctf_users u 
        JOIN teamates t ON u.id = t.user_id 
        JOIN completedchallenges uc ON u.id = uc.userid 
        JOIN challenges c ON uc.challengeid = c.id 
        GROUP BY t.team_id, c.id 
    ) AS team_challenges 
    JOIN teams ON team_challenges.team_id = teams.teamid 
    GROUP BY team_challenges.team_id;
        ";
$result = mysqli_query($conn, $sql);
// Save data into an associatve array (like python dictionary)
// Iterate through every single row in the result to convert to associative array 
while ($row = mysqli_fetch_assoc($result)) {
    // Add the row to the array of all users 
    array_push($teams, $row);
}
?>