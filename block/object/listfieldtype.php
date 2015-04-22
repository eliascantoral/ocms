<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fieldlist = get_listfieldtypes();
?>
<div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
    Campos personalizados
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
   <?php for($i=0;$i<sizeof($fieldlist);$i++){?>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="lnk_newfield" val="<?php echo $fieldlist[$i][0]?>"><?php echo $fieldlist[$i][1];?></a></li>
   <?php } ?>
  </ul>
</div>
<input type="hidden" id="ajax-answer">
<script>
    $(".lnk_newfield").click(function(){
        var type = $(this).attr("val");
        ajax_("101","&type="+type,false,"ajax-answer");
        var answer = $("#ajax-answer").val();
        $("#object_fields").append(answer);
    });
    function isChar(inputtxt){
        var letters = /^[a-zA-Z]+$/;
        return inputtxt.match(letters);        
    }
</script>


