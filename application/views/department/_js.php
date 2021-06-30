<link rel="stylesheet" href="<?=base_url()?>css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>css/buttons.dataTables.min.css">
<script src="<?=base_url()?>js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

<script>

var width = $(window).width();
$(function(){
    $(window).resize(function () { 
        var width = $(window).width();
    });
    
        $("#data-table1").DataTable({
        'ajax': '<?=base_url()?>home/department_response',
        "pageLength": 10,
        "lengthMenu": [
            [10, 25, 50, 100, -1 ],
            [10, 25, 50, 100, "All"]
        ],
        'order': [0, 'asc'],
        "responsive" : width > 800 ? false : {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
    });
})





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
                swal('Department Added',"Department Inserted",'success').then(function() {
            window.location = "<?=base_url()?>department";
            });
            }
        }
    })
})


$('#dep-form-edit').submit(function(e){
    e.preventDefault();
    var form_data = $("#dep-form-edit").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/department_edit_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                 swal('Department Updated',"Department Updated",'success').then(function() {
            window.location = "<?=base_url()?>department";
            });
            }
        }
    })
})

    function deleted(id){
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                }).then((willDelete) => {
                if (willDelete) {
                     $.ajax({
                        type:'POST',
                       data:{'id':id,'table':'ps_department','columnName':'status','columnvalue':'0'},
                        dataType: 'JSON',
                        url: "<?=base_url()?>home/delete_response",
                        success:function(response){
                            var stringified = JSON.stringify(response);
                            var obj = JSON.parse(stringified);
                            if(obj[0].Type=='Error'){
                                swal("Error","Action Not Perfomed ",'error')
                            }else{
                                swal("Department","Department Deleted ",'success')
                            }
                        }
                    })
                } else {
<<<<<<< HEAD

=======
>>>>>>> 2701cb187c236c6640e053ce8a117db4e0eb3b53
                    swal("Your imaginary file is safe!");
                }
                }); 
}




</script>