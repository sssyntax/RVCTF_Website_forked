<?php
session_start();
require_once "includes/connect.inc.php";
require_once "includes/verify.inc.php";
require_once "point_decay.php"; // <-- make sure to include the file if it's separate

function uploadFilesToDatabase($conn,$files,$challengeId){
    $sql = "INSERT INTO `additional_materials` (`file_name`, `challenge_id`) VALUES (?, ?)";
    foreach ($files as $file) {
        executeQuery($conn, $sql, [$file, $challengeId], 'si');
    }
}
function uploadFilesToServer($conn, $files, $challengeId, $targetDir = "../challengeMaterials/") {
    // Helper functions

    function newFileName($targetDir, $fileName) {
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileBaseName = pathinfo($fileName, PATHINFO_FILENAME);
        $uniqueFileName = $fileName;
        $counter = 1;

        while (file_exists($targetDir . $uniqueFileName)) {
            $uniqueFileName = $fileBaseName . '_' . $counter . '.' . $fileExtension;
            $counter++;
        }

        return $uniqueFileName;
    }
    $newFiles = [];
    for ($i = 0; $i < count($files['name']); $i++) {
        $file = [
            'name' => $files['name'][$i],
            'type' => $files['type'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
            'size' => $files['size'][$i],
        ];

        $uniqueFileName = newFileName($targetDir, $file['name']);
        $targetFilePath = $targetDir . $uniqueFileName;
        $newFiles[] = $uniqueFileName;

        // Check for any errors in the uploaded file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            onError($conn, "Error Uploading File: " . $file['name']);
        }

        // Check if the file is empty
        if (empty($file["name"])) {
            onError($conn, "Error Uploading File: " . $file['name']);
        }

        // Ensure the upload directory exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            onError($conn, "Error Uploading File: " . $file['name']);
        }

    }
    uploadFilesToDatabase($conn, $newFiles,$challengeId);
}

$difficultylst = ["Easy", "Medium", "Hard"];

if (!verify_login($conn)) {
    onError($conn, "Relogin required");
}

$userInfo = getUserInfo($conn, $_SESSION['userid']);
if (!$userInfo['admin']) {
    onError($conn, "Not Admin");
}

$title = getPostParam('title');
$author = getPostParam('author');
$points = getPostParam('points');
$difficulty = getPostParam('difficulty');
$category = getPostParam('category');
$desc = getPostParam('desc');
$solution = getPostParam('solution');

if (!$title || !$author || !$points || $difficulty === false || !$category || !$desc || !$solution) {
    onError($conn, "All fields are required");
}

$encrypted = sha1(FLAG_SALT . $solution);

$sql = "INSERT INTO `challenges` (`title`, `author`, `points`, `difficulty`, `category`, `description`, `solution`) VALUES (?, ?, ?, ?, ?, ?, ?)";
$insertId = executeQuery($conn, $sql, [$title, $author, $points, $difficulty, $category, $desc, $encrypted], 'ssiisss',true);

// Update points and first blood bonus after creation
updateChallengePoints($conn, $insertId);

//if (isset($_FILES['files'])) {
//    uploadFilesToServer($conn, $_FILES['files'], $insertId);
//}
if (isset($_FILES['files']) && !empty($_FILES['files']['name'][0])) {
    uploadFilesToServer($conn, $_FILES['files'], $insertId);
}
onSuccess($conn, 1);
