<?php
//THIS NEEDS TO CHANGE IF YOU ARE USING SERVER
$servername = "127.0.0.1";
$username = "root"; // for x10: pjjabycm_ctfdb
$password = ""; // for x10: q6sFckv3 
$db_name = "ctfdb"; // for x10: pjjabycm_ctfdb 
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