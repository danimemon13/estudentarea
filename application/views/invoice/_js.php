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
        'ajax': '<?=base_url()?>home/invoice_response',
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
function get_lead(){


    var lead_code = $('#lead_code').val();
    if(lead_code == ''){
     
       swal("Error","Please Fill Invoice id",'error')
      
      return false;
    }
    $.ajax({
            url: '<?=base_url()?>home/get_invoive_custumer_detail',
            type: 'POST',
            data: {'ID':lead_code},
            success: function(res) {
                modals("Lead Detials", res,'Add','addDetails()');    
            },
            error: function(e) {
                console.log('Ajax Error' + e)
            }
        })
}

function addDetails(){
  var radioid = $("#cus-id").val();
  var radioname = $("#cus-name:checked").val();
  var radioemail = $("#cus-email:checked").val();
  var radionumber = $("#cus-number:checked").val();
    if(radioid || radioname || radioemail || radionumber){
      $('#c-id').val(radioid);
      $('#c-name').val(radioname);
      $('#c-email').val(radioemail);
      $('#c-contact-no').val(radionumber);
      $('#myModal').modal('hide');
    }
}

$("#get-lead-detail").submit(function(e){
        e.preventDefault();
        var data = $("#get-lead-detail").serializeArray();
    
        $.ajax({
      type: "POST",
       url: '<?=base_url()?>home/invoice_add_response',
      data: data,
      success: function (response) {
        var  table = 'table';
        var  path = 'path';
        var  reff = 'reff';
        console.log(response)
       
        if(response == false){
        
        }
        else{
      swal('Invoice Added',"Invoice Inserted",'success').then(function() {
            window.location = "<?=base_url()?>invoice";
            });
        }
      },
      error : function(e){
          console.log('Ajax Error'+e)
        }
    });

    });
 




</script>