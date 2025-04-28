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

$action = $_POST['action'] ?? '';

if ($action === 'enable') {
    // Freeze timer at 5 hours
    $start_time = date('Y-m-d H:i:s', time() - 3600); // 1 hour ago
    $end_time = date('Y-m-d H:i:s', time() + (5 * 3600)); // 5 hours from now

    $sql = "UPDATE ctf_config SET start_time = ?, end_time = ?, casual_mode = 1 WHERE id = 1";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $start_time, $end_time);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect back to admin panel
    header("Location: ../index.php?filename=adminPanel");
    exit();
} elseif ($action === 'disable') {
    $sql = "UPDATE ctf_config SET casual_mode = 0 WHERE id = 1";
    mysqli_query($conn, $sql);

    // Redirect back to admin panel
    header("Location: ../index.php?filename=adminPanel");
    exit();
} else {
    echo json_encode(["error" => "Invalid action."]);
}
?>
