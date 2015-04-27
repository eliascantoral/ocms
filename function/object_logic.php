<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function create_newobjectype(){
    include_once 'backend/backend.php';
    $backend = new backend();
    $userid = get_userdata("userid");
    if($userid){
        $_SESSION["objecttypeid"] = $backend->save_objecttype("", "", $userid);
        return $_SESSION["objecttypeid"];
    }
    return false;
}
function update_objecttype($objectid, $name, $desc, $status){
    include_once 'backend/backend.php';
    $backend = new backend();
    $userid = get_userdata("userid");
    if($userid){
        $backend->update_objecttype($objectid, $name, $desc, $status);
        return true;
    }
    return false;
}
function delete_objecttype($objectid){
    include_once 'backend/backend.php';
    $backend = new backend();
    $userid = get_userdata("userid");
    if($userid!=false){
        $_SESSION["objecttypeid"] = false;
        return $backend->delete_objecttype($objectid, $userid);
    }
    return false;
}
function get_objecttypedata($objectid){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_objecttypedata($objectid);
}
function get_listfieldtypes(){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_objectsfieldtype();
}
function get_fieldconf($type){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_objectsfieldtype($type);    
}
function create_field($name, $id, $desc, $object, $type    ){
    include_once 'backend/backend.php';
    $backend = new backend();
    return  $backend->set_objectfield($name, $id, $desc, $object, $type);
}

function get_objecttypelist(){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_objecttypelist();
}