<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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