<?php
// Backend PHP code (get_first_blood_user.php)
require_once 'includes/connect.inc.php';

$challengeID = $_GET['challengeID'] ?? null;

if (!$challengeID) {
    echo json_encode(['error' => 'Challenge ID is required.', 'data' => null]);
    exit;
}

$sql = "SELECT u.username AS firstblood_username
        FROM challenges c
        LEFT JOIN ctf_users u ON c.firstblood_user_id = u.id
        WHERE c.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $challengeID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $challenge = $result->fetch_assoc();
    echo json_encode([
        'error' => null,
        'data' => ['firstblood_username' => $challenge['firstblood_username'] ?? 'No First Blood']
    ]);
} else {
    echo json_encode(['error' => 'Challenge not found', 'data' => null]);
}
?>

