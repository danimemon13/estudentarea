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
        'ajax': '<?=base_url()?>home/team_response',
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
$('#team-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#team-form").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/team_add_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Team Added',"Team Inserted",'success').then(function() {
            window.location = "<?=base_url()?>team";
            });
            }
        }
    })
})

$('#team-form-edit').submit(function(e){
    e.preventDefault();
    var form_data = $("#team-form-edit").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/team_edit_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Team Updated',"Team Updated",'success').then(function() {
            window.location = "<?=base_url()?>team";
            });
            }
        }
    })
})

function deleted(id){
    $.ajax({
        type:'POST',
        data:{'id':id,'table':'ps_team','columnName':'status','columnvalue':'0'},
        dataType: 'JSON',
        url: "<?=base_url()?>home/delete_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Team Deleted',"Team Deleted",'success').then(function() {
            window.location = "<?=base_url()?>team";
            });
            }
        }
    })
}
</script>