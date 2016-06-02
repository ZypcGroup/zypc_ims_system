<?php

	require_once "init.php";


	if($_POST){
		 $username = $_POST['aname'];
	     $password = $_POST['apassword'];
	     
	     $db = new db_sql_functions();

	     $rs = $db->admin_login_check($username,$password);

	     if($rs){
	     	$name = "tookenid";
	     	$value = time().mt_rand();
	     	setcookie($name,$value,time()+1200);
	      	$db = new db_sql_functions();
	     	$db->insert_tooken($value,time());
	  		echo "<meta http-equiv=\"Refresh\" content=\"0;url=html/user_list.html\">";
	     }else{
	     	$smarty->display('admin_login.tpl');
	     }	     
	}

	$smarty->display('admin_login.tpl');
?>
