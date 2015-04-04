<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        
        </div>
        <div id="ajax_loader">
        </div>
    </body>
</html>

<script>

	function show_message(where, message){
		$("#"+where).text(message);
		$("#"+where).show("fast");
		setTimeout(function(){$("#"+where).hide("fast");},3000)
	}
	$("#search_form").submit(function(){		
		var text = document.getElementById("search_text").value;
		if(text == ""){
			event.preventDefault();			
		}
	});
	
	
	function ajax_(action, data, update, dest){	
		$.ajax({
		  async:false, 
		  cache:false,
		  dataType:"html", 
		  type: 'POST',   
		  url: "<?php echo get_variable("ajax");?>",
		  data: "action="+ action + data, 
		  success:  function(respuesta){				
			if(update){
				if(dest==""){
					location.reload();
				}else{
					
					 window.location.assign(dest);
				}
				
			}else if(dest!=""){						
				document.getElementById(dest).value=respuesta;
			}
			$("#ajax_loader").fadeOut("fast");
		  },
		  beforeSend:function(){
			$("#ajax_loader").fadeIn( "slow" );
		  },
		  error:function(objXMLHttpRequest){$("#ajax_loader").fadeOut("fast");console.log(objXMLHttpRequest);}
		});
		
	}
	function ajax_async(action, data, update, dest){		
		$.ajax({
		  async:true, 
		  cache:false,
		  dataType:"html", 
		  type: 'POST',   
		  url: "<?php echo get_variable("ajax");?>",
		  data: "action="+ action + data, 
		  success:  function(respuesta){				
			if(update){
				if(dest==""){
					location.reload();
				}else{
					
					 window.location.assign(dest);
				}
				
			}else if(dest!=""){	
				document.getElementById(dest).innerHTML="";		
				document.getElementById(dest).innerHTML=respuesta;
			}
			$("#"+dest).removeClass("ajax_loader");
		  },
		  beforeSend:function(){
			$("#"+dest).addClass("ajax_loader");
		  },
		  error:function(objXMLHttpRequest){$("#"+dest).removeClass("ajax_loader");console.log(objXMLHttpRequest);}
		});
		
	}	
</script>