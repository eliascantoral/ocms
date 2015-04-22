<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form id="frm_newobject">
  <div class="form-group">
    <label for="txt_name">Nombre</label>
    <input type="text" class="form-control" id="txt_name" placeholder="El nombre del objeto (Video, Libro, Persona...)">
  </div>
  <div class="form-group">
    <label for="txt_desc">Descripción</label>
    <input type="text" class="form-control" id="txt_name" placeholder="El objeto se utilizara para ...">
  </div>
  <div class="form-group">
    <?php include 'listfieldtype.php';?>    
  </div> 
    <div id="object_fields" class="container-fluid">
        
        
    </div>
  <button type="submit" class="btn btn-default">Crear objeto</button>  
</form>

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
</script>