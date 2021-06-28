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
        'ajax': '<?=base_url()?>home/website_response',
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
});

$("#website-form").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "<?=base_url()?>Home/website_add_response",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
    success:function(response){
            console.log(response);
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                  swal('Website Added',"New Website Inserted",'success').then(function() {
            window.location = "<?=base_url()?>website";
            });
            }
        },        
    });
 }));

   function edit_website(id) {
        data = {
                action: 'edit',
                id: id
            }
        action('Edit Details', data, '', '')
    }

    function action(header, data, btn, clicks) {
        var data = data;
        $.ajax({
            url: '<?=base_url()?>home/website_action',
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
        $.ajax({
            url: '<?=base_url()?>home/website_action_response',
            type : 'POST',
            data : data,
            success:function(response){
                var stringified = JSON.stringify(response);
                var obj = JSON.parse(stringified);
                if(obj[0].Type=='Error'){
                    swal("Error","Action Not Perfomed ",'error')
                }else{
                    swal('Website Area Updated',"Updated",'success')
                    $('#data-table1').DataTable().ajax.reload();               
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
        data:{'id':id,'table':'ps_website','columnName':'display_id','columnvalue':'0'},
        dataType: 'JSON',
        url: "<?=base_url()?>home/delete_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "<?=base_url()?>website";
                    // swal("Poof! Your imaginary file has been deleted!", {
                    //   icon: "success",
                    // });
                } else {
                    swal("Your file is safe!");
                }
                });
            }
        }
    })
}



</script>