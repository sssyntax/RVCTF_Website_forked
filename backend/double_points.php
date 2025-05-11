<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/includes/connect.inc.php";
require_once __DIR__ . "/includes/verify.inc.php";

if (!verify_login($conn)) {
    onError($conn, "You are not logged in.");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
if ($userInfo['admin'] == 0) {
    onError($conn, "You do not have permission.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'activate') {
        // ✅ Enable double points for all challenges
        $stmt = $conn->prepare("UPDATE challenges SET double_points = 1");
        if (!$stmt->execute()) {
            die("Failed to activate double points: " . $stmt->error);
        }

    } elseif ($action === 'deactivate') {
        // ❌ Disable double points for all challenges
        $stmt = $conn->prepare("UPDATE challenges SET double_points = 0");
        if (!$stmt->execute()) {
            die("Failed to deactivate double points: " . $stmt->error);
        }

    } else {
        die("Invalid action.");
    }

    // Redirect after the action is completed
    header("Location: ../index.php?filename=adminPanel");
    exit;
} else {
    die("Invalid request.");
}
?>
