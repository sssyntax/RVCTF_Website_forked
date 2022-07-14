<?php
//THIS NEEDS TO CHANGE IF YOU ARE USING SERVER
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "ctfdb";
$conn = new mysqli($servername,$username,$password,$db_name);
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $stmt = $mysqli->prepare($sql);
    if ($stmt->bind_param($types, ...$params)===false){
    	return false;
    }
    if ($stmt->execute()===false){
    	return false;
    }
    return $stmt;
}

?>