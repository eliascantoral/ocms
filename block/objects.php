<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    
$mainmenusub = isset($_GET["sub"])? $_GET["sub"]: "1";///Activa la primera opcion del main menu
?>
<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="<?php echo $mainmenusub=='1'?'active ':'';?>"><a href="?opt=<?php echo $mainmenuopt;?>&sub=1">Objetos</a></li>
    <li role="presentation" class="<?php echo $mainmenusub=='2'?'active ':'';?>"><a href="?opt=<?php echo $mainmenuopt;?>&sub=2">Agregar</a></li>
</ul>


