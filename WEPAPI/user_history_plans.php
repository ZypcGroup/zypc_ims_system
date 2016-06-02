<?php
	require_once "../config/db.config.php";
	require_once "../includes/db.class.php";
	require_once "../includes/db_function.class.php";

	$username = $_SESSION['username'];

	if(!isset($username)){
		echo "1";
		exit();
	}


	$db = new db_sql_functions();
	$historyTestArray= $db->get_user_history_plans($username);
	$finallyArray['data'] = $historyTestArray;
 	$historyTestJSON=json_encode($finallyArray,JSON_UNESCAPED_UNICODE);
 	echo $historyTestJSON;
	
?>