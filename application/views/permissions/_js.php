<script>
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
</script>