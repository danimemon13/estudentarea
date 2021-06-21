<script>
$('#department-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#department-form").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/deparment_add_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Department Added',"New Department Inserted",'success')
                $('#role-form').trigger('reset');
            }
        }
    })
})
</script>