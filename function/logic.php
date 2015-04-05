<?php
	/**************************************************************************************************************************/	
	function init_vars(){
		session_start();		
	}
	function get_variable($var){
		switch($var){
			case "home": return "http://localhost/ocms";
			case "ajax": return "function/service.php";
			default:{return "";}
		}
	}
	function is_login(){
		$user = false;
		if(isset($_SESSION["ocms_userid"])){$user = $_SESSION["ocms_userid"];}
		return $user;
	}
	function create_log($object_id){
		$key = isset($_SESSION["ocms_key"])?$_SESSION["ocms_key"]:create_sessionkey();
		$user = false;
		$rate = 0;
		include_once("backend/backend.php");
		$backend = new backend();	
		//test_data();
		return $backend->create_log($object_id, $key, $user, $rate);
	}
	
	function create_sessionkey(){
		$_SESSION["ocms_key"]= time() . random_text();
	}
	function kill_sessionkey(){		
		$_SESSION["ocms_key"] = false;
	}
	function get_sessionkey(){
		if(!isset($_SESSION["ocms_key"])){
			create_sessionkey();
		}
		return $_SESSION["key"];	
	}
	function random_text($size = 10){
		$text = "";
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/*-+_";
		for($i=0;$i<$size;$i++){
			$text.=$characters[mt_rand(0, strlen($characters))];			
		}
		return $text;
	}
	function array_contain($where, $what, $pos=false){		
		for($i=0;$i<sizeof($where);$i++){
			if($pos===false){
				if($where[$i]==$what) return $i+1;			
			}else{
				if($where[$i][$pos]==$what) return $i+1;
			}			
		}
		return false;
	}
        
/********************************************************************************************************************/	
        
        include_once 'user_logic.php';
        include_once 'home_logic.php';
?>