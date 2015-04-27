<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    function try_login($user, $pass){
            include_once("backend/backend.php");
            $backend = new backend();
            $user = $backend->login($user, $pass);
            if($user === false)return false;
            session_start();
            $_SESSION["ocms_userid"] =  $user[0]; 
            $_SESSION["ocms_name"] =  $user[1] . " " . $user[2];
            $_SESSION["ocms_mail"] =  $user[3];
            $_SESSION["ocms_rol"] = $user[4];
            $_SESSION["ocms_status"] = $user[5];
            return $user;
    }
    function get_userdata($data){
        if(isset($_SESSION["ocms_".$data])){return $_SESSION["ocms_".$data];}
        return false;
    }
?>
