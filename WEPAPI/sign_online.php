<?php
require_once "init.php";
//if(!isset($_SESSION['username']) || $_SESSION['username']==false){
//    $_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
//    echo "<meta http-equiv=\"Refresh\" content=\"0;url=login.php\">";
//    exit();
//}
$timelive = 60; 
$db = new db_sql_functions();
$res = $db->check_online_users($timelive);
$ss = implode("、", $res);
$nums = count($res);

$finallyArray['data'] = array('count'=>$nums);
$historyTestJSON=json_encode($finallyArray,JSON_UNESCAPED_UNICODE);
echo $historyTestJSON;
?>