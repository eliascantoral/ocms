<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        <div class="list-group">
            <?php $menu = get_mainmenu();
                for($i=0; $i<sizeof($menu);$i++){?>
                    <a href="?opt=<?php echo $menu[$i][0];?>" class="list-group-item <?php if($mainmenuopt==$menu[$i][0]) echo "active";?>">
                        <img src="image/<?php echo $menu[$i][3];?>" width="35px" alt="<?php echo $menu[$i][1]?>" title="<?php echo $menu[$i][1]?>">
                        <span class="hidden-xs"><?php echo $menu[$i][1]?></span>
                    </a>            
               <?php }
            ?>
        </div>    