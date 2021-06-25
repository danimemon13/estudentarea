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
            url: '<?=base_url()?>home/invoice_customer_details',
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
  
  $("#custumer_dtl tbody input[type='checkbox']:checked").each(function() {
        var selector = $(this).closest('tr');
        var name = selector.find('td:eq(1)').text();
        var email =selector.find('td:eq(2)').text();
        var number =selector.find('td:eq(3)').text();
        var lead = $("#cus-id").val();
        // console.log(name)
        // console.log(email)
        // console.log(number)
        // console.log(lead)
        $("#c-id").val(lead);
        $("#c-name").val($.trim(name));
        $("#c-email").val($.trim(email));
        $("#c-contact-no").val($.trim(number));
        $(".close").click();
        $('#myModal').modal('hide');
  })

  // var radioid = $("#cus-id").val();
  // var radioname = $("#cus-name:checked").val();
  // var radioemail = $("#cus-email:checked").val();
  // var radionumber = $("#cus-number:checked").val();
  //   if(radioid || radioname || radioemail || radionumber){
  //     $('#c-id').val(radioid);
  //     $('#c-name').val(radioname);
  //     $('#c-email').val(radioemail);
  //     $('#c-contact-no').val(radionumber);
  //     $('#myModal').modal('hide');
  //   }
}
var services = {};
$("#get-lead-detail").submit(function(e){
        e.preventDefault();
         var invoice_detail = document.createElement("input");
        invoice_detail.type = "hidden";
        invoice_detail.value = JSON.stringify(services.cartlist());
        invoice_detail.name = "invoice_detail";
  $("#get-lead-detail").append(invoice_detail);
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
          
            });
        }
      },
      error : function(e){
          console.log('Ajax Error'+e)
        }
    });

    });
  
      services.cart = [];
      services.Item = function (service_name,service,page,qty,turn,quality,subject,industry,writin_style,voice,inc_key,audience,gender,ref_link,inc_free_image,branded_generic,comments) {
          this.service_name = service_name
          this.service = service
          this.page = page
          this.qty = qty
          this.turn = turn
          this.quality = quality
          this.subject = subject
          this.industry = industry
          this.writin_style = writin_style
          this.voice = voice
          this.inc_key = inc_key
          this.audience = audience
          this.gender = gender
          this.ref_link = ref_link
          this.inc_free_image = inc_free_image
          this.branded_generic = branded_generic
          this.comments = comments

      };
      // Add items too cart
      services.addtocart = function (service_name,service,page,qty,turn,quality,subject,industry,writin_style,voice,inc_key,audience,gender,ref_link,inc_free_image,branded_generic,comments) {
        if(service == '' ){
          return 0;
        }
        
          for (var i in this.cart) {
              if (this.cart[i].service === service  ) {
                  alert('This item already exist in list');
                  return;
              }
               if (this.cart[i].service === "Select Service"  ) {
                  return;
              }
          }
          var item = new this.Item(service_name,service,page,qty,turn,quality,subject,industry,writin_style,voice,inc_key,audience,gender,ref_link,inc_free_image,branded_generic,comments);
          this.cart.push(item);
      };
       services.cartlist = function () {
          var cartcopy = [];
          for (var i in this.cart) {
              var item = this.cart[i];
              var itemcopy = {};
              for (var p in item) {
                  itemcopy[p] = item[p]
              }
              cartcopy.push(itemcopy);
          }
          return cartcopy;
      };

       $(document).on("click",'.addToList',function(e){
          e.preventDefault();
         var  service_name = $("#service option:selected").text();
         var  service = $("#service").val();
         var  page  = $("#pages").val();
         var  qty = $("#quantity").val();
         var  turn = $("#turnaround").val();
         var  quality = $("#quality").val();
         var  subject = $("#subject").val();
         var  industry = $("#industry").val();
         var  writin_style = $("#preferred").val();
         var  voice = $("#preferred_voice").val();
         var  inc_key = $("#include_keyword").val();
         var  audience = $("#target_audience").val();
         var  gender = $("#target_gender").val();
         var  ref_link = $("#refrence_link").val();
         var  inc_free_image = $("#inc_free_image").val();
         var  branded_generic = $("#branded_generic").val();
         var  comments = $("#comments").val();
services.addtocart(service_name,service,page,qty,turn,quality,subject,industry,writin_style,voice,inc_key,audience,gender,ref_link,inc_free_image,branded_generic,comments);
      serviceDisplay();
        });
       function serviceDisplay(){
          var cartarray = services.cartlist();
          console.log(cartarray);
          var input ="";
          for (var i in cartarray) {
            var com = (cartarray[i].comments == '')? 'No Comments' : cartarray[i].comments ;
          input += `<tr>
                    <td >`+ cartarray[i].service_name +`</td > 
                    <td >`+ com +`</td >
                    <td><a href="#" class="remitem" data-name=`+cartarray[i].service+` class="btn btn-danger btn-xs">x</a></td
                    </tr>`;

          }
          $(".insertItems").html(input);
          
            if(input != ''){
             
              $("#saveBtn").attr("disabled",false);
            }else{
               
               $("#saveBtn").attr("disabled",true);
            }

          }

         services.removeitemfromcartall = function (service ) // remove all item from cart
          {
              for (var i in this.cart) {
                  if (this.cart[i].service == service ) {
                      this.cart.splice(i, 1);
                      break;
                  }
              }
          }

        $('.table').on('click', '.remitem', function (e){
           var index =  $('.remitem').index(this);

           var name = $($('.remitem')[index]).data("name");
             services.removeitemfromcartall(name);
          serviceDisplay();
        });
        function get_check_val(){
          $("tbody input[type='checkbox']:checked").each(function() {
                var selector = $(this).closest('tr');
                var name = selector.find('td:eq(2)').text();
                var email =selector.find('td:eq(3)').text();
                var number =selector.find('td:eq(4)').text();
                var lead = $("#radioStacked4").val();
                $("#lead_id").val(lead);
                $("#name").val($.trim(name));
                $("#email_val").val($.trim(email));
                $("#number").val($.trim(number));
                $(".close").click();
              var valu = $("#email_val");
              
              if(valu.val() != ''){
                $("#email_send").attr("disabled",false);
              }else{
                $("#email_send").attr("disabled",true);
              }
          })

        }

        $("#quantity").on('input',function(){
          var valu = $(this).val()
          if(valu <= 0){
            $(this).val('')
          }
        })

 function deleted(id){
    $.ajax({
        type:'POST',
        data:{'id':id,'table':'ps_invoice_basic','columnName':'display_id','columnvalue':'0'},
        dataType: 'JSON',
        url: "<?=base_url()?>home/delete_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Invoice Deleted',"Invoice Deleted",'success').then(function() {
            window.location = "<?=base_url()?>invoice";
            });
            }
        }
    })
}
function edit_invoice(id,invoice_no){
    data = {
            action: 'edit',
            id: id,
            inv_no: invoice_no
        }
    action('Edit Details', data, '', '')
  }
  function delete_invoice(id,invoice_no){
    data = {
            action: 'delete',
            id: id,
            inv_no: invoice_no
        }
    action('Edit Details', data, '', '')
  }
  function history_invoice(id,invoice_no){ 
    data = {
            action: 'history',
            id: id,
            inv_no: invoice_no
        }
    action('Edit Details', data, '', '')
  }
  function action(header, data, btn, clicks) {
      var data = data;
      $.ajax({
          url: '<?=base_url()?>home/invoice_action',
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
      url: '<?=base_url()?>home/invoice_action_response',
      type : 'POST',
      data : data,
      success : function(res){
          console.log(res);
          if(res == '1'){
              swal('Invoice Details','Invoice Details Update','success');
              $('#data-table1').DataTable().ajax.reload();
          }else{
              swal('Invoice Details','Server Error','error');
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
      url: '<?=base_url()?>home/invoice_action_response',
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




</script>