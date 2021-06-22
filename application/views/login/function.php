<script>
 	$("#login_form").submit(function(e){
 		e.preventDefault();
 		var form_data = $("#login_form").serializeArray();
	    $.ajax({
	      type:'post',
	      data:form_data,
	      dataType: 'JSON',
	      url: "<?=base_url()?>home/login_user",
		  beforeSend: function() {
			$('#login_form button').html('Processing......');
			},
	      success:function(response){
			$('#login_form button').html('Login');
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
						$(".alert").html("<strong>Setting up Please Wait......</strong><img src='<?=base_url() ?>img/loader.gif'>")
	                  setTimeout(function(){ 
						window.location = "<?=base_url()?>dashboard";
						}, 2000);	
	              }
	          }
	      },
		  error:function(err){
			  console.log(err);
		  }
	  });
 	});
 </script>