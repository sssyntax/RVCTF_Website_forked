<?php
require_once "includes/connect.inc.php";

if (!isset($_GET['challengeID'])) {
    echo json_encode(["error"=>"No challenge id provided"]);
    exit();
}

$sql = "SELECT COUNT(*) FROM completedchallenges WHERE challengeid = ?";
$res = prepared_query($conn, $sql, [$_GET['challengeID']], 'i');
$res->bind_result($count);
$res->fetch();
mysqli_stmt_close($res);

echo json_encode(["data"=>$count]);