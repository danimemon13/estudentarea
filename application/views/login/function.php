<script>
 	$("#login_form").submit(function(e){
 		e.preventDefault();
 		var form_data = $("#login_form").serializeArray();
	    $.ajax({
	      type:'post',
	      data:form_data,
	      dataType: 'JSON',
	      url: "<?=base_url()?>home/login_user",
	      success:function(response){
	          console.log(response);
	          var len = response.length;
	          for(var i=0; i<len; i++){
	              if(response[i].Type=='Error'){
	              	  $("strong").html('Oops ! '+response[i].msg);	
	                  //$("#"+response[i].Error_type).removeClass("hidden");
	                  $(".alert-danger").slideDown();
	                  setTimeout(function(){ $(".alert-danger").slideUp(); }, 2000);
	              }
	              if(response[i].Type=='Success'){
						$(".alert").addClass('alert-success');
						$(".alert").removeClass('alert-danger');
						$(".alert").css("display", "block");
						$(".alert").html('')
						$(".alert").html("Setting up Please Wait......<img src='<?=base_url() ?>img/loader.gif' height='100' width='100'>")
	                  setTimeout(function(){ 
						window.location = "<?=base_url()?>dashboard";
						}, 2000);	
	              }
	          }
	      }
	  });
 	});
 </script>