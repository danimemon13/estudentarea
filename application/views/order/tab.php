<?php
$action = $_POST['action'];
$arr['id'] = $_POST['id'];
$order_id = $_POST['id'];
$get_order_details = $this->Home_models->selectrecords('ps_order_main',$arr);
$order_code =$get_order_details[0]['order_code'];
// echo $order_code;
// die();
if($action == 'edit_order'){
?>
    
    <div id="order_code">
        <h4>Order Code (<?=$order_code; ?>)</h4>
    </div>
    <div id="order_detail">
    <!-- TABS START-->

    <ul class="nav nav-tabs mb-2 mytabactive" id="myTab" role="tablist">
    
        <li class="nav-item">
            <a class="nav-link active" title="comm" id="home_order" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comments</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" title="assign_ord" id="home_order" data-toggle="tab" href="#assign_order" role="tab" aria-controls="order_a" aria-selected="true">Assign Order</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" title="sub_ord" id="home_order" data-toggle="tab" href="#s_order" role="tab" aria-controls="s_order" aria-selected="true">Submit order</a>
        </li>
  
        <li class="nav-item">
            <a class="nav-link" title="sub_ord" id="home_order" data-toggle="tab" href="#order_update_tab" role="tab" aria-controls="order_update_tab" aria-selected="true">Update order</a>
        </li>

    </ul>

    <!-- TABS END-->

    <div class="tab-content" id="myTabContent">
        
      
        
        <div class="tab-pane fade active show" id="comments" role="tabpanel" aria-labelledby="home_order">
            <div class="form-group " style="margin: auto;">
                <form autocomplete="off" id="comment_form">
                    <div class="form-group">
                        <label for="comments" class="mr-1">Comments</label>
                        <textarea class="form-control" name="comments" id="comments" placeholder="Enter Comments" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_comments_" class="mr-1">File</label>
                        <input id="file_comments_<?=$order_id;?>" name="file[]" multiple type="file" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="progress mb-3">
                            <div id="progress_comments_<?=$order_id;?>" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <button type="button" onClick="comments_action(this.id)" id="<?=$order_id;?>" class="btn btn-primary col-md-4 col-lg-4 col-xs-12 col-sm-12">Save</button>
                    </div>
                </form>
            </div>
        </div>
     
        <div class="tab-pane fade  " id="assign_order" role="tabpanel" aria-labelledby="home_order">
            <form autocomplete="off" id="assign_form">
                <div class="form-group" style="margin: auto;">
                    <div class="form-group">
                        <label for="description" class="mr-1">Writer Name</label>
                        <select class="custom-select form-control select2" name="writer_name">
                        <option selected>Select User </option>
                        <option value=""></option>                       
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="mr-1">Comments</label>
                        <textarea class="form-control" name="comments" id="comments" placeholder="Enter Comments" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="progress mb-3">
                            <div id="progress_assign_<?=$order_id;?>" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" onClick="assign_action(this.id)" id="<?=$order_id;?>" class="btn btn-primary col-md-4 col-lg-4 col-xs-12 col-sm-12">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="s_order" role="tabpanel" aria-labelledby="home_order">
                <div class="form-group " style="margin: auto;">
                    <form autocomplete="off" id="submit_form_<?=$order_id;?>">
                             <div class="form-group">
                                <label for="description" class="mr-1">Select Task</label>
                                
                                <select class="form-control shadow-sm p-3 shadow-sm p-3" name="task_id">

                                </select>
                            </div>
                        <div class="form-group">
                            <label for="description" class="mr-1">Comments </label>
                            <textarea class="form-control" name="comments"  placeholder="Enter Comments" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" class="mr-1">File</label>
                            <input id="file_submit_<?=$order_id;?>" name="file[]" multiple type="file" class="form-control" />
                        </div>
                        <div class="form-group">
                            <div class="progress mb-3">
                                <div id="progress_submit_<?=$order_id;?>" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onClick="submit_action(this.id)" id="<?=$order_id;?>"  class="btn btn-primary col-md-4 col-lg-4 col-xs-12 col-sm-12">Save</button>
                        </div>
                    </form>
                </div>
            </div>    
        <div class="tab-pane fade" id="order_update_tab" role="tabpanel" aria-labelledby="home_order">
            <div class="form-group" style="margin: auto;">
                <form autocomplete="off" id="update_revision_<?=$order_id;?>">
                    <div class="form-group">
                        <label for="description" class="mr-1">Order update</label>
                        <select class="form-control" name="order_status" id="description" onChange="get_revision_value(this.value);">
                            <option>Select Option</option>
                            <option value="6">Delivered</option>
                            <option value="9">Revision</option>
                            
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="description" class="mr-1">Comments</label>
                        <textarea class="form-control" name="comments" id="description" placeholder="Enter Comments" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="mr-1">File</label>
                        <input id="file_revision_<?=$order_id;?>" name="file[]" multiple type="file" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="progress mb-3">
                            <div id="progress_revision_<?=$order_id;?>" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" onClick="order_revision(this.id)" id="<?=$order_id;?>" class="btn btn-primary col-md-4 col-lg-4 col-xs-12 col-sm-12">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>

       $('.select2').select2({ width: '100%' })
        
        $("#delivery_datesss").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd'
        });
        $("#delivery_date").datepicker({
            startDate: new Date(),
            format: 'yyyy-mm-dd'
        });
        $("#delivery_date_2").datepicker({
            startDate: new Date('<?=$delivery_time_3;?>'),
            format: 'yyyy-mm-dd'
        });
        
   $("#add").click(function(){
        // var childClones = $("#fieldsForCopy").children().clone(true,true);
        var childClones = $("#Wrapper").children().clone(true,true);
        
        $('#pastHere').append(childClones);
    });
    
    $(document).on('click', '.btn_remove', function(){
        //var div_id = $(this).closest('div').find('.display_image').attr(id);
        var div_id = $(this).closest('div');
        div_id.remove();  
    });
        
    </script>
    </div>
    
<?php 
}
?>