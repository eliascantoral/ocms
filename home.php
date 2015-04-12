<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mainmenuopt = isset($_GET["opt"])? $_GET["opt"]: "1";///Activa la primera opcion del main menu

?>
<div class="row">
    <div class="col-xs-4 col-md-2">
            <?php include 'block/mainmenu.php';?>
        
    </div>    
    <div class="col-xs-12 col-sm-10 col-md-10">
        <?php 
            switch($mainmenuopt){
                case "1": include_once 'block/miperfil.php';break;
                case "2": include_once 'block/users.php';break;
                case "3": include_once 'block/objects.php';break;
                default : include_once 'block/miperfil.php';break;
            }
        ?>    
    </div>  
</div>