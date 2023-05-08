<?php
define("SECRET_KEY","uoqcy169(361");
define("salt","vnljh19d1996v");
define("CSRF_TOKEN_SECRET",'wxVy4t0EpypTDfPsEhqXfU92wsjnFce1bLMtbDyKWpbiVXGUp1D');

//THIS NEEDS TO CHANGE IF YOU ARE USING SERVER
// $servername = "localhost"; // for default: 127.0.0.1 
// $username = "pjjabycm_ctfdb"; // for x10: pjjabycm_ctfdb | for others: root
// $password = "q6sFckv3"; // for x10: q6sFckv3 
// $db_name = "pjjabycm_ctfdb"; // for x10: pjjabycm_ctfdb 
// TO EDIT LOCALLY, UNCOMMENT THIS
$servername = "127.0.0.1"; // for default: 127.0.0.1 
$username = "root"; // for x10: pjjabycm_ctfdb | for others: root
$password = ""; // for x10: q6sFckv3 
$db_name = "ctfdb"; // for x10: pjjabycm_ctfdb 
$conn = new mysqli($servername,$username,$password,$db_name);
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $stmt = $mysqli->prepare($sql);
    if ($stmt->bind_param($types, ...$params)===false){
        echo "parameter binding error";
    	return false;
    }
    if ($stmt->execute()===false){
        echo "Statement execution error";
    	return false;
    }
    return $stmt;
}

class iimysqli_result
{
    public $stmt, $nCols;
}   

function iimysqli_stmt_get_result($stmt)
{
    /**    EXPLANATION:
     * We are creating a fake "result" structure to enable us to have
     * source-level equivalent syntax to a query executed via
     * mysqli_query().
     *
     *    $stmt = mysqli_prepare($conn, "");
     *    mysqli_bind_param($stmt, "types", ...);
     *
     *    $param1 = 0;
     *    $param2 = 'foo';
     *    $param3 = 'bar';
     *    mysqli_execute($stmt);
     *    $result _mysqli_stmt_get_result($stmt);
     *        [ $arr = _mysqli_result_fetch_array($result);
     *            || $assoc = _mysqli_result_fetch_assoc($result); ]
     *    mysqli_stmt_close($stmt);
     *    mysqli_close($conn);
     *
     * At the source level, there is no difference between this and mysqlnd.
     **/
    $metadata = mysqli_stmt_result_metadata($stmt);
    $ret = new iimysqli_result;
    if (!$ret) return NULL;

    $ret->nCols = mysqli_num_fields($metadata);
    $ret->stmt = $stmt;

    mysqli_free_result($metadata);
    return $ret;
}

function iimysqli_result_fetch_array(&$result)
{
    $ret = array();
    $code = "return mysqli_stmt_bind_result(\$result->stmt ";

    for ($i=0; $i<$result->nCols; $i++)
    {
        $ret[$i] = NULL;
        $code .= ", \$ret['" .$i ."']";
    };

    $code .= ");";
    if (!eval($code)) { return NULL; };

    // This should advance the "$stmt" cursor.
    if (!mysqli_stmt_fetch($result->stmt)) { return NULL; };

    // Return the array we built.
    return $ret;
}



function GenerateRandomToken($length = 32){
    if(!isset($length) || intval($length) <= 8 ){
      $length = 32;
    }
    if (function_exists('random_bytes')) {
        return bin2hex(random_bytes($length));
    }
    if (function_exists('mcrypt_create_iv')) {
        return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
    }
    if (function_exists('openssl_random_pseudo_bytes')) {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}
function storeTokenForUser($conn,$user,$token){
    $token = hash_hmac("sha256",$token,salt);
    $SQL = 'INSERT INTO `tokens`(`token`,`userid`) VALUES (?,?)';
    
    print_r($token);
    print_r($user);
    $stmt = prepared_query($conn,$SQL,[$token,$user],"si");
    if (!$stmt) return false;
    mysqli_stmt_close($stmt);
    $SQL = "SELECT MAX(`tokenid`) FROM `tokens` WHERE `token` = ? AND `userid` = ?";
    $stmt = prepared_query($conn,$SQL,[$token,$user],"si");
    if (!$stmt) return false;
    $res = iimysqli_stmt_get_result($stmt);
    $tokenid = iimysqli_result_fetch_array($res)[0];
    return $tokenid;
}

function fetchTokenByUserName($conn,$user,$tokenid){
    # Finds the user's token in the database
    $SQL = 'SELECT `token` FROM `tokens` WHERE `userid` = ? AND `tokenid` = ?';
    $stmt = prepared_query($conn,$SQL,[$user,$tokenid],"si");
    if (!$stmt) return false;
    $res = iimysqli_stmt_get_result($stmt);
    if (!$res) return false;
    $res2 = iimysqli_result_fetch_array($res);
    if (!$res2) return false;
    $token = $res2[0];
    mysqli_stmt_close($stmt);
    return $token;
}

function destroyCookie($conn){
    
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    
    // print_r($_COOKIE);
    if (!$cookie) return false;
    list ($user, $token, $tokenid,$mac) = explode(':', $cookie);
    if (!hash_equals(hash_hmac('sha256', $user . ':' . $token.':'.$tokenid, SECRET_KEY), $mac)) return false;
    
    $SQL = 'DELETE FROM `tokens` WHERE `userid` = ? AND `tokenid` = ?';
    $stmt = prepared_query($conn,$SQL,[$user,$tokenid],"ii");
    mysqli_stmt_close($stmt);
    setcookie("rememberme", "", time()-3600,"/");
}



function rememberMe($conn) {
    $cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '';
    // If cookie exists
    if ($cookie) {
        list ($user, $token, $tokenid,$mac) = explode(':', $cookie);
        if (!hash_equals(hash_hmac('sha256', $user . ':' . $token.':'.$tokenid, SECRET_KEY), $mac)) {
            return false;
        }
        $usertoken = fetchTokenByUserName($conn,$user,$tokenid);
        if (!$usertoken) return;
        if (hash_equals($usertoken, hash_hmac("sha256",$token,salt))) {
            $_SESSION["loggedin"] = true;
            $_SESSION["userid"] = $user;
            return true;
        }
        else{
            return false;
        }
    }

}
?>