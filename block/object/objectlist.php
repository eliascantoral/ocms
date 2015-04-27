<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$objecttypelist = get_objecttypelist();
?>

<br><br>
<div class="panel panel-primary">
  <div class="panel-heading">
    Tipos de objeto
  </div>
  <div class="panel-body">
        <table class="table table-striped table-hover">
            <tr><th>No.</th><th>Nombre</th><th>Descripción</th><th>Status</th></tr>
            <?php for($i=0;$i<sizeof($objecttypelist);$i++){?>
                <tr><td><?php echo $i+1;?></td><td><?php echo $objecttypelist[$i][1];?></td><td><?php echo $objecttypelist[$i][2];?></td><td><?php echo $objecttypelist[$i][3]=='1'?"Publico":"Oculto";?></td></tr>
            <?php }?>
        </table>  
  </div>
</div>

