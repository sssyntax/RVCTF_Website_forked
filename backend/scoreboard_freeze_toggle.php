<?php
require_once __DIR__ . "/includes/connect.inc.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'freeze') {
        // 🛡️ Manually force freeze: Set override + allow recalculation
        $stmt = $conn->prepare("UPDATE ctf_config SET freeze_override = 1, freeze_done = 0 WHERE id = 1");
        $stmt->execute();

    } elseif ($action === 'unfreeze') {
        // 🛡️ Unfreeze: Remove override + reset freeze_done
        $stmt = $conn->prepare("UPDATE ctf_config SET freeze_override = 0, freeze_done = 0 WHERE id = 1");
        $stmt->execute();

    } else {
        die("Invalid action.");
    }

    header("Location: ../index.php?filename=adminPanel");
    exit;
} else {
    die("Invalid request.");
}
?>
