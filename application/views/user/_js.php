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
        'ajax': '<?=base_url()?>home/user_response',
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
    $("#data-table2").DataTable({
        'ajax': '<?=base_url()?>home/user_access_response',
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
                $("#"+html_column).append("<option value=''>Select Department</option>");
                for( var i = 0; i<len; i++){
                    var id = obj[i]['id'];
                    var name = obj[i]['name'];
                    
                $("#"+html_column).append("<option value='"+id+"'>"+name+"</option>");
                
            }
        }
    })
    
}

function check_role1(){
    var team = $('#team').val();
    var department = $('#departmentDiv').val();
    var role = $('#role').val();
    // alert(team+"dep"+department+"role"+role)
    if(role == 2){
        $.ajax({
            type:'POST',
            data:{'team':team,'department':department,'role':1},
            url: "<?=base_url()?>home/getMangersAndTeamLeads",
            success:function(response){
                console.log(response);
                var stringified = JSON.stringify(response);
                var obj = JSON.parse(response);
                var len = obj.length;
                    $("#dynamic_team_leads").empty();
                    var dynamic = "<label>Select Manager</label> <select class='form-control shadow-sm p-3 ' name='manager' required> <option value=''>Select Manger</option>";
                    for( var i = 0; i<len; i++){
                        var id = obj[i]['fk_parent_id'];
                        var name = obj[i]['first_name']+" - "+obj[i]['last_name'];
                        
                        dynamic += "<option value='"+id+"'>"+name+"</option>";
                    }   
                    dynamic += "</select>";
                $("#dynamic_team_leads").append(dynamic);
            }
        })
    }else if(role == 3){
        $.ajax({
            type:'POST',
            data:{'team':team,'department':department,'role':2},
            url: "<?=base_url()?>home/getMangersAndTeamLeads",
            success:function(response){
                console.log(response);
                var stringified = JSON.stringify(response);
                var obj = JSON.parse(response);
                var len = obj.length;
                    $("#dynamic_team_leads").empty();
                    var dynamic = "<label>Select Team Lead</label> <select class='form-control shadow-sm p-3 ' onchange='get_managers()' id='team_leads' name='team_leads' required> <option value=''>Select Team Lead</option>";
                    for( var i = 0; i<len; i++){
                        var id = obj[i]['fk_parent_id'];
                        var name = obj[i]['first_name']+" - "+obj[i]['last_name'];
                        
                        dynamic += "<option value='"+id+"'>"+name+"</option>";
                    }   
                    dynamic += "</select>";
                $("#dynamic_team_leads").append(dynamic);
            }
        })
    }else{
        $("#dynamic_team_leads").html('');
    }
}

function get_managers(){
    var team = $('#team').val();
    var department = $('#departmentDiv').val();
    var team_lead = $('#team_leads').val();
    if(team_lead == ''){
        $("#dynamic_managers").html('');
        return false;
    }
    $.ajax({
            type:'POST',
            data:{'team':team,'department':department,'role':1},
            url: "<?=base_url()?>home/getMangersAndTeamLeads",
            success:function(response){
                console.log(response);
                var stringified = JSON.stringify(response);
                var obj = JSON.parse(response);
                var len = obj.length;
                    $("#dynamic_managers").empty();
                    var dynamic = "<label>Select Manager</label> <select class='form-control shadow-sm p-3 ' name='manager' required> <option value=''>Select Manger</option>";
                    for( var i = 0; i<len; i++){
                        var id = obj[i]['fk_parent_id'];
                        var name = obj[i]['first_name']+" - "+obj[i]['last_name'];
                        
                        dynamic += "<option value='"+id+"'>"+name+"</option>";
                    }   
                    dynamic += "</select>";
                $("#dynamic_managers").append(dynamic);
            }
        })
}

function change_users(team_lead_id){
    $.ajax({
        type:'POST',
        data:{'team_lead_id':team_lead_id,'action':'viewmodal'},
        url: "<?=base_url()?>home/user_assign",
        success:function(response){
            modals('',response,'','')
        }
    })
}

function user_assign(){
    var users = $('#mandator_select').val()
    var team_lead = $('#team_lead').val();
    var action = $('#action').val();
    // console.log('users'+users+'team_lead_id'+team_lead+'action'+action);
    $.ajax({
        type:'POST',
        data:{'users':users,'team_lead_id':team_lead,'action':action},
        url: "<?=base_url()?>home/user_team_response",
        beforeSend: function() {
          $('.card-body button').text('Processing')
        },
        success:function(response){
            $('.card-body button').text('Update User')
            console.log(response);
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal('User Added',"User Assigned",'success');
                $('#myModal').modal('hide');
                $('.modal-backdrop').hide();
            }
        }
    })
}

$('#name').multiselect({
    columns: 1,
    placeholder: 'Select Users',
    search: true,
    selectAll: true,
    maxHeight: 260,
    buttonWidth:"100%",
    enableFiltering:true,
    enableCaseInsensitiveFiltering:true,
    includeSelectAllOption: true,
    allowClear: true
});

$('#name2').multiselect({
    columns: 1,
    placeholder: 'Select Users',
    search: true,
    selectAll: true,
    maxHeight: 260,
    buttonWidth:"100%",
    enableFiltering:true,
    enableCaseInsensitiveFiltering:true,
    includeSelectAllOption: true,
    allowClear: true
});

$('#mandator_select').multiselect({
      columns: 1,
      placeholder: 'Select Users',
      search: true,
      selectAll: true,
      maxHeight: 260,
      buttonWidth:"100%",
      enableFiltering:true,
      enableCaseInsensitiveFiltering:true,
      includeSelectAllOption: true,
      allowClear: true

});

$('#user-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#user-form").serializeArray();
    $.ajax({
        type:'POST',
        data:form_data,
        url: "<?=base_url()?>home/user_add_response",
        success:function(response){
            // console.log(response);
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

$('#user-edit-form').submit(function(e){
    e.preventDefault();
    var form_data = $("#user-edit-form").serializeArray();
    // console.log(form_data);
    // return false;
    $.ajax({
        type:'POST',
        data:form_data,
        // dataType: 'JSON',
        url: "<?=base_url()?>home/user_edit_response",
        success:function(response){
            //console.log(response);
            var obj = JSON.parse(response);
            console.log(obj[0].Type);
            if(obj[0].Type=='Error'){
                swal("Error",obj[0].msg,'error')
            }else{
                swal("User Details",obj[0].msg,'success')
            }
        }
    })
})

$('#assign-web').submit(function(e){
    e.preventDefault();
    var form_data = $("#assign-web").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/user_website_assign_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Website Area',"Website Area Updated",'success').then(function() {
            window.location = "<?=base_url()?>user";
            });
            }
        }
    })
})

$('#remove_web').submit(function(e){
    e.preventDefault();
    var form_data = $("#remove_web").serializeArray();
    // console.log(form_data)
    $.ajax({
        type:'POST',
        data:form_data,
        dataType: 'JSON',
        url: "<?=base_url()?>home/user_website_unassign_response",
        success:function(response){
            var stringified = JSON.stringify(response);
            var obj = JSON.parse(stringified);
            if(obj[0].Type=='Error'){
                swal("Error","Action Not Perfomed ",'error')
            }else{
                swal('Remove Website',"Remove Website",'success').then(function() {
            window.location = "<?=base_url()?>user";
            });
            }
        }
    })
})

// TABLE VIEW FUNCTION
$('#mandator_select').on('change', function() {
    $("#numberselected").html('');
    var data=[];
    var $el=$("#mandator_select");
    $el.find('option:selected').each(function(){
        data.push({value:$(this).val(),text:$(this).text()});
    });
    var team_lead_name = $('#team_lead_name').text();
    // var table;
    for(i = 0; i < data.length; i ++){
        var table = '<tr>';
        table += '<td>'+team_lead_name+'</td>';
        table += '<td>'+data[i]['text']+'</td>';
        table += '</tr>'
        // console.log(data[i]['text']);
        // var user = '<span class="badge badge-warning es-label" style="margin:10px">'+data[i]['text']+'</span>';
        $("#numberselected").append(table)
        // console.log(table);
    }  
});

// LABEL VIEW FUNCTION
// $('#mandator_select').on('change', function() {
//     $("#numberselected").html('');
//     var data=[];
//     var $el=$("#mandator_select");
//     $el.find('option:selected').each(function(){
//         data.push({value:$(this).val(),text:$(this).text()});
//     });
//     for(i = 0; i < data.length; i ++){
//         console.log(data[i]['text']);
//         var user = '<span class="badge badge-warning es-label" style="margin:10px">'+data[i]['text']+'</span>';
//         $("#numberselected").append(user)
//     }  
// });

</script>