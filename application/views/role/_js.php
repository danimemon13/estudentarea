<script>
$('#role-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#role-form").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/role_add_response",
        success:function(response){
            console.log(response);
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Role Added',"New Role Inserted",'success')
                $('#role-form').trigger('reset');
            }
        }
    })
})
</script>