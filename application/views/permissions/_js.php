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
                var role_id = '<input type="text" value="'+id+'" name="role_id" style="display:none"/>';
                var depart_id = '<input type="text" value="'+departmentDiv+'" name="depart_id" style="display:none"/>';
                $("#destination_form").append(role_id);
                $("#destination_form").append(depart_id);
            }
        });
	}
	function check_all(id){
		var id = id;
        if ($("#"+id).is(":checked")) {
            $( "#add_access_"+id ).prop( "checked", true );
            $( "#edit_access_"+id ).prop( "checked", true );
            $( "#delete_access_"+id ).prop( "checked", true );
            $( "#view_access_"+id ).prop( "checked", true );
        }
        else{
            $( "#add_access_"+id ).prop( "checked", false );
            $( "#edit_access_"+id ).prop( "checked", false );
            $( "#delete_access_"+id ).prop( "checked", false );
            $( "#view_access_"+id ).prop( "checked", false );
        }
	}
	
</script>