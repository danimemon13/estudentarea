<script>
	$("#destination_form").submit(function(e){
		e.preventDefault();
		var form_data = $("#destination_form").serializeArray();
		$.ajax({
			type:'post',
			data:form_data,
			url: "<?=base_url()?>home/permission_proces",
			success:function(response){
                console.log(response);
            }
		});
	});
	function get_role(id){
		var value = value;
        $.ajax({//getDetilsById
            url: '<?=base_url()?>home/getallData',
            type: 'post',
            data: {'ID':id,'column':'depart_id','table':'ps_role'},
            dataType: 'json',
            success:function(response){

                var len = response.length;
                console.log(response);
                //role
                $("#role").empty();
                $("#role").append("<option >Select Role</option>");
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#role").append("<option value='"+id+"'>"+name+"</option>");

                }
                //$("#city").empty();
                //$("#destination_form").html(response);
                
            }
        });
	}
	function get_permission(id){
		var id = id;
		var departmentDiv = $("#departmentDiv option:selected").val();
        $.ajax({
            url: '<?=base_url()?>home/getPermissions',
            type: 'post',
            data: {'role_id':id,'departmentDiv':departmentDiv},
            success:function(response){

                var len = response.length;

                //$("#city").empty();
                $("#destination_form").html(response);
                
            }
        });
	}
	function check_all(id){
		var add_access = $('#add_access_'+id);
		var edit_access = $('#edit_access_'+id);
		var delete_access = $('#delete_access_'+id);
		var view_access = $('#view_access_'+id);
	    if(add_access.prop("checked") == true){
	    	add_access.removeAttr('checked');
	    }
	    else{
	    	add_access.attr('checked','checked');
	    }
	    if(edit_access.prop("checked") == true){
	    	edit_access.removeAttr('checked');
	    }
	    else{
	    	edit_access.attr('checked','checked');
	    }
	    if(delete_access.prop("checked") == true){
	    	delete_access.removeAttr('checked');
	    }
	    else{
	    	delete_access.attr('checked','checked');
	    }
	    if(view_access.prop("checked") == true){
	    	view_access.removeAttr('checked');
	    }
	    else{
	    	view_access.attr('checked','checked');
	    }
	}
</script>