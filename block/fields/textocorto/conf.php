<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


///////conf textocorto
?>

<form class="form" id="newfieldform_<?php echo $tempid?>">
  <div class="form-group">
    <label for="txt_name_<?php echo $tempid?>">Nombre</label>
    <input type="text" class="form-control" id="txt_name_<?php echo $tempid?>" placeholder="Nombre del campo" required>
  </div>
  <div class="form-group">
    <label for="txt_id_<?php echo $tempid?>">ID</label>
    <input type="text" class="form-control" id="txt_id_<?php echo $tempid?>" placeholder="Este valor identificara el campo dentro del tema" required>
  </div>    
  <div class="form-group">
    <label for="txt_desc_<?php echo $tempid?>">Descripción</label>
    <input type="text" class="form-control" id="txt_desc_<?php echo $tempid?>" placeholder="Descripción del campo" required>
  </div>
    <button type="submit" class="btn btn-default" id="btn_newfield_<?php echo $tempid?>">Guardar</button>
    <button type="button" class="btn btn-danger" id="btn_calcelfield_<?php echo $tempid?>">Eliminar</button>
    <input type="text" id="ajax-answer_<?php echo $tempid?>" value="">
</form>

<script>
    $("#txt_name_<?php echo $tempid?>").keypress(function(evt){        
         var charCode = evt.which || evt.keyCode;
         var charStr = String.fromCharCode(charCode);
         if(isChar(charStr)){
             $("#txt_id_<?php echo $tempid?>").val($("#txt_id_<?php echo $tempid?>").val() + charStr.toLowerCase());
         }
    });
    $("#newfieldform_<?php echo $tempid?>").submit(function(event){
        event.preventDefault();        
        var name = $("#txt_name_<?php echo $tempid?>").val();
        var id = $("#txt_id_<?php echo $tempid?>").val();
        var desc = $("#txt_desc_<?php echo $tempid?>").val();
        ajax_("102","&type=<?php echo $type;?>&fieldname="+name+"&fieldid="+id+"&fielddesc="+desc,false,"ajax-answer_<?php echo $tempid?>");        
    });
    $("#btn_calcelfield_<?php echo $tempid?>").click(function(){
        $("#delete_field_tempid").val('<?php echo $tempid?>');
        $("#delete_field").modal("show");
    });    
</script>