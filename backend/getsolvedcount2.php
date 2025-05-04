<?php
function getSolvedCount($conn, $challengeID) {
    $sql = "SELECT COUNT(*) AS count FROM completedchallenges WHERE challenge_id = ?";
    $result = fetchDataFromQuery($conn, $sql, [$challengeID], 'i', "Failed to fetch challenge completion count");

    if (empty($result)) {
        return 0;
    }

    return (int) $result[0]['count'];
}
?>
