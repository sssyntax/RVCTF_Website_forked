<?php
function getDifficulty($conn, $challengeID) {
    $sql = "SELECT difficulty FROM challenges WHERE id = ?";
    $result = fetchDataFromQuery($conn, $sql, [$challengeID], 'i', "Failed to fetch challenge difficulty");

    if (empty($result)) {
        return 0; // or handle it as you wish
    }

    return (int) $result[0]['difficulty'];
}
?>
