<?php
	
	require_once "../config/db.config.php";
	require_once "../includes/db.class.php";
	require_once "../includes/db_function.class.php";
	
	
	$username = $_SESSION['username'];

	if(!isset($username)){
		echo "1";
		exit();
	}
	
	$db       = new db_sql_functions();
    
	$oneweekTimeLineArray  =  $db->get_oneweek_time_line();	

	$tempArray['data'] = $oneweekTimeLineArray;
	$mergeJSON = json_encode($tempArray,JSON_UNESCAPED_UNICODE);

	echo($mergeJSON);

?>
