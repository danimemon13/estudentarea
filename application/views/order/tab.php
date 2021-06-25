<?php

$action = $_POST['action'];
$arr['id'] = $_POST['id'];
$order_id = $_POST['id'];
$get_order_details = $this->Home_models->selectrecords('ps_order_main',$arr);
$order_code =$get_order_details[0]['order_code'];
$role_id = $_SESSION['user_profile'][0]['role'];
$department = $_SESSION['user_profile'][0]['department'];
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
        <?php if($role_id == '1' || $role_id == '2'){ ?>
        <li class="nav-item">
            <a class="nav-link" title="assign_ord" id="home_order" data-toggle="tab" href="#assign_order" role="tab" aria-controls="order_a" aria-selected="true">Assign Order</a>
        </li>
        <?php } ?>
        <?php if($role_id == '3'){ ?>
        <li class="nav-item">
            <a class="nav-link" title="sub_ord" id="home_order" data-toggle="tab" href="#s_order" role="tab" aria-controls="s_order" aria-selected="true">Submit order</a>
        </li>
        <?php } ?>
        <?php if($role_id == '2' && $department == '2'){ ?>
        <li class="nav-item">
            <a class="nav-link" title="sub_ord" id="home_order" data-toggle="tab" href="#order_update_tab" role="tab" aria-controls="order_update_tab" aria-selected="true">Update order</a>
        </li>
        <?php } ?>
    </ul>

    <!-- TABS END-->

    <div class="tab-content" id="myTabContent">
        
    <?php 
        // $this->db->select('
        //     ps_order_child.*,
        //     ps_services.name
        // ');
        // $this->db->from('ps_order_child');
        // $this->db->join('ps_services','ps_order_child.services = ps_services.id');
        // $query = $this->db->get()->result();
        // print_r($query);
        // die();
    ?>
        
        <div class="tab-pane fade active show" id="comments" role="tabpanel" aria-labelledby="home_order">
            <div class="form-group " style="margin: auto;">
                <form autocomplete="off" id="comment_form">
                    <div class="form-group">
                        <label for="comments" class="mr-1">Comments</label>
                        <textarea class="form-control" name="comments" id="comments" placeholder="Enter Comments" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file_comments_" class="mr-1">File</label>
                        <input id="file_r" name="file[]" multiple type="file" class="form-control" />
                    </div>
                 
                  
                    <div class="form-group">
                        <input type="text" name="id" value="<?=$order_id?>" style="display:none;"/>
                        <input type="text" name="action" value="comment_order" style="display:none;"/>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
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
                        <option value = ''>Select User </option>
                        <?php 
                        $filter['team'] = $_SESSION['user_profile'][0]['team'];
                        $filter['department'] = $_SESSION['user_profile'][0]['department'];
                        $filter['role'] = '3';
                        $get_users = $this->Home_models->selectrecords('ps_user_profile',$filter); 
                        foreach($get_users as $getuser){
                        ?>
                        <option value="<?=$getuser['fk_parent_id']?>"><?=$getuser['first_name']." - ".$getuser['last_name']?></option>
                        <?php   
                        }
                        ?>
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
                        <input type="text" name="id" value="<?=$order_id?>" style="display:none;"/>
                        <input type="text" name="action" value="assigned_order" style="display:none;"/>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="s_order" role="tabpanel" aria-labelledby="home_order">
            <div class="form-group " style="margin: auto;">
                <form autocomplete="off" id="submit_form">
                        <div class="form-group">
                            <label for="description" class="mr-1">Select Task</label>    
                            <select class="form-control shadow-sm p-3 shadow-sm p-3" name="task_id">
                                <option value="">Select Task</option>
                                <?php 
                                $this->db->select('
                                ps_order_child.*,
                                ps_services.name
                                ');
                                $this->db->from('ps_order_child');
                                $this->db->join('ps_services','ps_order_child.services = ps_services.id');
                                $get_users = $this->db->get()->result();
                              
                                foreach($get_users as $getuser){
                                ?>
                                <option value="<?=$getuser->id?>"><?=$getuser->name?></option>
                                <?php   
                                }
                                ?>
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="description" class="mr-1">Comments </label>
                        <textarea class="form-control" name="comments"  placeholder="Enter Comments" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="description" class="mr-1">File</label>
                        <input id="file_rr" name="file[]" multiple type="file" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="progress mb-3">
                            <div id="progress_submit_<?=$order_id;?>" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="id" value="<?=$order_id?>" style="display:none;"/>
                        <input type="text" name="action" value="submit_order" style="display:none;"/>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
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
                        <input id="file_r" name="file[]" multiple type="file" class="form-control" />
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
            $("#assign_form").submit(function(e){
                e.preventDefault();
                var data = $("#assign_form").serializeArray();
                //console.log(data);
                action_res('Change Team',data,'','');
            });
         $("#comment_form").submit(function(e){
    
                
                e.preventDefault();
                var data = $("#comment_form").serializeArray();    
                var fd = new FormData();
                var file_data = $('#file_r')[0].files
                for (var i = 0; i < file_data.length; i++) {
                    fd.append("file_" + i, file_data[i]);
                }
    
                
    
                $.each(data,function(key,input){
                    fd.append(input.name,input.value);
                });
                action_res_img('Add',fd,'','');
            });


         $("#submit_form").submit(function(e){
    
                
                e.preventDefault();
                var data = $("#submit_form").serializeArray();    
                var fd = new FormData();
                var file_data = $('#file_rr')[0].files
                for (var i = 0; i < file_data.length; i++) {
                    fd.append("file_" + i, file_data[i]);
                }
    
                
    
                $.each(data,function(key,input){
                    fd.append(input.name,input.value);
                });
                action_res_img('Add',fd,'','');
            });


        $("#status-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#status-form").serializeArray();
                    // console.log(data);
                    action_res('Change Status',data,'','');
                });
    
         

        </script>
    </div>
    
    <?php 
}else if($action == 'history_order'){
    $this->db->select('
        ps_order_history.*,
        CONCAT(ps_user_profile.first_name," ",ps_user_profile.last_name) as username
    ');
    $this->db->from('ps_order_history');
    $this->db->join('ps_user_profile', 'ps_user_profile.fk_parent_id = ps_order_history.added_by');
    $this->db->where('order_id',$id);
    
    $order_history = $this->db->get()->result();

    ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-uppercase text-center">#</th>
                <th class="text-uppercase text-center">User Name</th>
                <th class="text-uppercase text-center">Date</th>
                <th class="text-uppercase text-center">Message</th>
                <th class="text-uppercase text-center">File</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            foreach ($order_history as $order_history_row) {
                $count++;
                ?>
                <tr>
                    <td class="text-uppercase text-center"><?=$count?></td>
                    <td class="text-uppercase text-center"><?=$order_history_row->username?></td>
                    <td class="text-uppercase text-center"><?=$order_history_row->date ?></td>
                    <td class="text-uppercase text-center"><?=$order_history_row->comment?></td>
                    <?php 
                    if($order_history_row->files != '0'){
                        ?>
                        <td><a class="badge badge-primary es-label" download href="<?=base_url()."". $order_history_row->files?>"  >download</a></td>
                        <?php
                    }else{
                        ?>
                        <td>No File Found</td>
                        <?php
                    }
                        ?>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <?php
}
?>