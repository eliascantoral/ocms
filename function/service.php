<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    //print_r($_POST);
    if(isset($_POST["action"])){
        switch ($_POST["action"]){
            case "0":{//Login
                if(isset($_POST["user"]) && isset($_POST["pass"])){
                    include_once('logic.php');
                    $result = try_login($_POST["user"], $_POST["pass"]);
                    if($result){
                        echo json_encode(array('r'=>1,'d'=>$result));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Usuario o contraseña incorrectos."));
                        
                    }
                }
                break;}
                
            case "101":{///Agregar formulario de configuracón de campos personalizados
                if(isset($_POST["type"])){
                    $type = $_POST["type"];
                    include_once 'logic.php';
                    $tempid = time().$type;
                    $field = get_fieldconf($type);
                    ?>
                        <div class="panel panel-default" id="panel_<?php echo $tempid;?>">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $field[0][1];?></h3>
                                <input type="hidden" id="pane_status_<?php echo $tempid;?>" value="1">
                            </div>
                            <div class="panel-body">
                                <?php include '../block/fields/'.$field[0][3].'/conf.php';?>
                            </div>
                        </div>                    
                    <?php                     
                }
                break;}
            case "102":{///Guardar o actualizar campo personalizado
                if(isset($_POST["type"])){
                    include_once 'logic.php';
                    $type = $_POST["type"];
                    $field = get_fieldconf($type);
                    include '../block/fields/'.$field[0][3].'/function.php';
                    savefield($_POST);
                }
                break;}
            case "103":{/// Eliminar o¿tipo de objeto
                if(isset($_POST["objectid"])){
                    session_start();
                    include_once 'logic.php';
                    $objectid = $_POST["objectid"];
                    delete_objecttype($objectid);
                    
                }
                break;}
            case "104": {/// Update object type
                if(isset($_POST["objectid"]) && isset($_POST["name"]) && isset($_POST["desc"]) && isset($_POST["status"])){
                    session_start();
                    include_once 'logic.php';
                    if(update_objecttype($_POST["objectid"],$_POST["name"],$_POST["desc"],$_POST["status"])){
                        echo json_encode(array('r'=>1,'d'=>"Se han guardado los cambios con exito."));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Ocurrio un error por favor intente nuevamente."));
                    }
                    
                }
                break;}
        }
        
    }

    
?>