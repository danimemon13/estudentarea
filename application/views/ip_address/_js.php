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
        'ajax': '<?=base_url()?>home/ip_address_response',
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
$('#ip-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#ip-form").serializeArray();
    $.ajax({
        type:'POST',
        data:form_data,
        url: "<?=base_url()?>home/ip_address_add_response",
        success:function(response){
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal('IP Added',"New IP Inserted",'success')
                $('#ip-form').trigger('reset');
            }
        }
    })
})
$('#ip-edit-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#ip-edit-form").serializeArray();
    // console.log(form_data);
    // return false;
    $.ajax({
        type:'POST',
        data:form_data,
        // dataType: 'JSON',
        url: "<?=base_url()?>home/ip_address_edit_response",
        success:function(response){
            //console.log(response);
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal("Ip Details",obj[0].msg,'success')
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
                data:{'id':id,'table':'ps_ip_allowed','columnName':'status','columnvalue':'0'},
                dataType: 'JSON',
                url: "<?=base_url()?>home/delete_response",
                success:function(response){
                    var stringified = JSON.stringify(response);
                    var obj = JSON.parse(stringified);
                    if(obj[0].Type=='Error'){
                        swal("Error",obj[0].msg,'error')
                    }else{
                        swal("Success",obj[0].msg,'success')
                    }
                }
            })
        } else {
            swal("Your imaginary file is safe!");
        }
    }); 
}
</script>