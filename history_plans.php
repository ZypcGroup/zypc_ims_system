<?php

	require_once "../config/db.config.php";
	require_once "../includes/db.class.php";
	require_once "../includes/db_function.class.php";

	if(!$_GET){
		echo "<meta http-equiv=\"Refresh\" content=\"0;url=../admin_login.php\">";
		exit();
	}


	$db = new db_sql_functions();
	
	//检查时间是否过期，如果时间过期，删除之前的tooken重定向到登录页面；没有过期检查tooken是否一致
	$currentTime =  time();
	//拿到cookie里的tookenid
	$tookenid=$_COOKIE['tookenid'];
	//echo 'tookenid'.$tookenid.'<br>';
	//如果tookenid 为空，跳转至登录页面

	if(empty($tookenid)){
		echo '1';
		exit();
	}

	$rs_array 	 =    $db->select_tooken($tookenid);

	//如果存在tooken
	if(!empty($rs_array)){

		
		$tookenid  = $rs_array['tooken'];
		$loginTime = $rs_array['time'];

		//更当前时间做一个判断
		$remainTime = $currentTime - $loginTime;

	
		// echo $currentTime.'当前时间<br>';
		// echo $loginTime.'登时间录<br>';
		// echo $remainTime.'时间维持<br>';
		//大于20分钟
		if( $remainTime > 1200 ){
			$db->delete_tookenid($tookenid);
			echo '1';
			exit();
		}


	}else{
		echo '1';
		exit();
	}

	
	$username = $_GET['username'];
	$historyArray = $db->get_user_history_plans($username);
	$tempArray['data'] = $historyArray;

	if(empty($historyArray )){
		
		$flagArray['data'] = array(
								array('admin_flag'=>0)
							);
		echo json_encode($flagArray,JSON_UNESCAPED_UNICODE);
		exit();
	}else{
		$hostoryJSON = json_encode($tempArray,JSON_UNESCAPED_UNICODE);
		echo $hostoryJSON;
	}

?>