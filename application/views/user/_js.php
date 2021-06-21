<script>
$('#user-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#user-form").serializeArray();
    // console.log(form_data);
    // return false;
    $.ajax({
        type:'POST',
        data:form_data,
        // dataType: 'JSON',
        url: "<?=base_url()?>home/user_add_response",
        success:function(response){
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal('User Added',"New User Inserted",'success')
                $('#user-form').trigger('reset');
            }
        }
    })
})
function getdatabyTeam(id,table,column,html_column){
    $.ajax({
        type:'POST',
        data:{'ID':id,'table':table,'column':column},
        url: "<?=base_url()?>home/getallData",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(response);
            var len = obj.length;
                $("#"+html_column).empty();
                $("#"+html_column).append("<option >Select Department</option>");
                for( var i = 0; i<len; i++){
                    var id = obj[i]['id'];
                    var name = obj[i]['name'];
                    
                $("#"+html_column).append("<option value='"+id+"'>"+name+"</option>");
                
            }
        }
    })
    
}


</script>