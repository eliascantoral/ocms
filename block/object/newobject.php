<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$newobjectid = isset($_GET["objecttype"])?$_GET["objecttype"]:false;
if(!$newobjectid){
    if(isset($_SESSION["objecttypeid"]) && $_SESSION["objecttypeid"]!=false){
        $newobjectid = $_SESSION["objecttypeid"];
    }else{
        $newobjectid = create_newobjectype(); 
    }   
}

$objecttypedata = get_objecttypedata($newobjectid);
//print_array($objecttypedata);


?>

<input type="hidden" id="ajax-answer" value="">
<form id="frm_newobject">
    <input type="hidden" id="txt_id" value="<?php echo $newobjectid;?>">
  <div class="form-group">
    <label for="txt_name">Nombre</label>
    <input type="text" class="form-control" id="txt_name" placeholder="El nombre del objeto (Video, Libro, Persona...)" value="<?php echo $objecttypedata[0];?>">
  </div>
  <div class="form-group">
    <label for="txt_desc">Descripción</label>
    <input type="text" class="form-control" id="txt_desc" placeholder="El objeto se utilizara para ..." value="<?php echo $objecttypedata[1];?>">
  </div>
  <div class="form-group">
    <?php include 'listfieldtype.php';?>    
  </div> 
    <div id="object_fields" class="container-fluid">
        
        
    </div>
  <button type="submit" class="btn btn-default"><?php echo $objecttypedata[2]=='2'?"Crear objeto":"Actualizar";?></button>
  <button type="button" id="btn_newobject_cancel" class="btn btn-danger">Cancelar</button>
</form>
<div class="alert alert-success message" id="msj_newobjecttypeok" role="alert">...</div>
<div class="alert alert-danger message" id="msj_newobjecttypeerror" role="alert">...</div>


<div id="delete_objecttype" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Borrar Tipo de Objeto</h4>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro de eliminar este tipo de objeto?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_deleteobecttype">Si</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="delete_field" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminación de Campo</h4>
      </div>
      <div class="modal-body">
        <p>¿Esta seguro de eliminar este campo? los valores ingresados de los objetos ya no podrán ser accedidos.</p>
        <input type="hidden" id="delete_field_tempid" value="0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_deletefield">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $("#btn_deletefield").click(function(){
        $("#delete_field").modal("hide");
        var val = $("#delete_field_tempid").val();
        $("#panel_"+val).hide("fast");
        $("#txt_status_"+val).val("0");              
    });
    $("#btn_newobject_cancel").click(function(){
        $("#delete_objecttype").modal();
    });
    $("#btn_deleteobecttype").click(function(){
       $("#delete_objecttype").modal("hide");
        var objectid = $("#txt_id").val();
        ajax_("103", "&objectid="+objectid, true, "?opt=<?php echo $mainmenuopt?>");
    });
    $("#frm_newobject").submit(function(event){
        event.preventDefault();
        var id = $("#txt_id").val();
        var name = $("#txt_name").val();
        var desc = $("#txt_desc").val();
        if(id!="" && name!="" && desc!=""){            
            ajax_("104", "&objectid="+id +"&name="+ name + "&desc="+ desc + "&status=1", false, "ajax-answer");
            var answer = $("#ajax-answer").val();
            json = jQuery.parseJSON( answer );
            if(json.r==1){
                 show_message("msj_newobjecttypeok",json.d);
            }else{
                 show_message("msj_newobjecttypeerror",json.d);
            }            
        }else{
            alert("Debe completar los datos.");
        }
    });
</script>