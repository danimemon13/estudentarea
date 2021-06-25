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
        'ajax': '<?=base_url()?>home/leads_response',
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

$('#lead-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#lead-form").serializeArray();
    // console.log(form_data);
    // return false;
    $.ajax({
        type:'POST',
        data:form_data,
        // dataType: 'JSON',
        url: "<?=base_url()?>home/leads_add_response",
        success:function(response){
            //console.log(response);
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal('Lead Added',"New Lead Inserted",'success')
                $('#lead-form').trigger('reset');
            }
        }
    })
})
    function edit_leads(id) {
        data = {
                action: 'edit',
                id: id
            }
        action('Edit Details', data, '', '')
    }
    function view(id) {
        data = {
                action: 'view',
                id: id
            }
        action('View Details', data, '', '')
    }
    function history(id) {
        data = {
                action: 'delete',
                id: id
            }
        action('History Details', data, '', '')
    }
    function action(header, data, btn, clicks) {
        var data = data;
        $.ajax({
            url: '<?=base_url()?>home/leads_action',
            type: 'POST',
            data: data,
            success: function(res) {
                if(header == 'edit'){
                    $('#myModal .modal-lg').css('max-width' , '800px')
                }else{
                    $('#myModal .modal-lg').css('max-width' , '1200px')
                }
                modals(header, res, btn, clicks);

            },
            error: function(e) {
                console.log('Ajax Error' + e)
            }
        })
    }
    
    function action_res(header,data){
      var data = data;
      $.ajax({
        url: '<?=base_url()?>home/leads_action_response',
        type : 'POST',
        data : data,
        success : function(res){
            console.log(res);
            if(res == '1'){
                swal('Lead Details','Lead Details Update','success');
                $('#data-table1').DataTable().ajax.reload();
            }else{
                swal('Lead Details','Server Error','error');
            }
          
        },
        error : function(e){
          console.log('Ajax Error'+e)
        }
      })
    }
        
    function action_res_img(header,data){
      var data = data;
      $.ajax({
        url: '<?=base_url()?>home/leads_action_response',
        type : 'POST',
        data : data,
        contentType: false,
        processData: false,
        success : function(res){
            if(res == '1'){
                swal('Lead Details','Lead Updated','success');
                $('#data-table').DataTable().ajax.reload();
            }else{
                swal('Lead Details','Action Not Perfomed','error');
                console.log(res);
            }
        },
        error : function(e){
          console.log('Ajax Error'+e)
        }
      })
    }

        function deleted(id){
    $.ajax({
        type:'POST',
        data:{'id':id,'table':'ps_leads','columnName':'display_id','columnvalue':'0'},
        dataType: 'JSON',
        url: "<?=base_url()?>home/delete_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Lead Deleted',"Lead Deleted",'success').then(function() {
            window.location = "<?=base_url()?>leads";
            });
            }
        }
    })
}
</script>