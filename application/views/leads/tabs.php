<?php 
$action = $_POST['action'];
$id = $_POST['id'];

if($action == 'edit'){
    ?>
    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
            
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" title="com" data-toggle="tab" href="#comments_tab" role="tab" aria-controls="home5" aria-selected="true">Comments</a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="review-stats" data-toggle="tab" href="#review_change" role="tab" aria-controls="contact5" aria-selected="false">Review Status</a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="add-chat" data-toggle="tab" href="#chat_change" role="tab" aria-controls="contact5" aria-selected="false">Add Chat</a>
            </li>
        
            <!-- <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="remind" data-toggle="tab" href="#reminder_tab" role="tab" aria-controls="contact5" aria-selected="false">Reminder</a>
            </li> -->
    
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="own" data-toggle="tab" href="#own_tab" role="tab" aria-controls="contact5" aria-selected="false">Ownership</a>
            </li>
        
            <!-- <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="change-own" data-toggle="tab" href="#own_change" role="tab" aria-controls="contact5" aria-selected="false">Change Owner</a>
            </li> -->
    </ul>
    <div class="tab-content" id="myTabContent" style="border: 1px solid #dddddd;">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="comments_tab" >
                <form autocomplete="off" id="comments-form">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="">Select Lead Status</option>
                            <?php
                            foreach($status as $statuses){
                            ?>
                            <option value="<?=$statuses['id']?>"><?=$statuses['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Comments</label>
                        <textarea class="form-control" rows="6" name="comments"></textarea>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <input type="text" name="id" value="<?=$id?>" style="display:none;"/>
                        <input type="text" name="action" value="comments_add" style="display:none;"/>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="review_change" >
                <form autocomplete="off" id="review-form">
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Status</label>
                            <select class="form-control" name="status">
                                <option>Select Status</option>
                                <option value="1">Lead Qualify</option>
                                <option value="2">Lead Dis-Qualify</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Comments</label>
                            <textarea class="form-control" rows="6" name="comments"></textarea>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-8"></div>
                    <div class="form-group col-md-1">
                        <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                        <input type="text" name="action" value="reviewstatus" style="display:none;"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="chat_change">
                <form autocomplete="off" id="chat-form" enctype="multipart/form-data">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Comments</label>
                        <textarea class="form-control" rows="6" name="comments"></textarea>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                        <label for="description" class="mr-1">File</label>
                        <input id="file_r" name="file[]" multiple type="file" class="form-control" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                        <div class="progress mb-3">
                            <div id="progress_comments" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-8"></div>
                    <div class="form-group col-md-1">
                        <input type="text" name="action" value="addchat" style="display:none;"/>
                        <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="reminder_tab"> 
                <form autocomplete="off" id="reminder-form">
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Select Date Time</label>
                            <div class="input-group date" id="delivery_date">
                                <input type="date" id="delivery_dates"  name="date" class="form-control" value="">
                                <div class="input-group-addon">
                                    <!--<button type='button' class="btn btn-outline-primary sidebar_icon mr-2"><i class="icofont-navigation-menu"></i> </button>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="col-md-3" style="float:left;">
                                <select class="form-control" name="hours">
                                    <option>HH</option>
                                    <?php
                                    for($i=1;$i<=12;$i++){
                                        ?>
                                        <option><?=str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-3" style="float:right;">
                                <select class="form-control" name="zone">
                                    <option>AM/PM</option>
                                    <option>AM</option>
                                    <option>PM</option>
                                </select> 
                            </div>
                            <div class="col-md-3" style="float:right;">
                                <select class="form-control" name="second">
                                    <option>SS</option>
                                    <?php
                                    for($i=0;$i<=59;$i++){
                                        ?>
                                        <option><?=str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                        <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                            <div class="col-md-3" style="float:right;">
                                <select class="form-control" name="minute">
                                    <option>MM</option>
                                    <?php
                                    for($i=0;$i<=59;$i++){
                                        ?>
                                        <option><?=str_pad($i, 2, "0", STR_PAD_LEFT);?></option>
                                        <?php
                                    }
                                    ?>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Select Type of reminder</label>
                            <select class="form-control" name="type" id='select' required>
                                <option value='0'>Select Option</option>
                                <option>Call Reminder</option>
                                <option>Follow-up Reminder</option>
                                <option>Payment Reminder</option>
                                <option>Other Reminder</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Comments</label>
                            <textarea class="form-control" rows="6" name="comments"></textarea>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8"></div>
                        <div class="form-group col-md-1">
                            <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                            <input type="text" name="action" value="reminder" style="display:none;"/>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="own_tab">
                <form autocomplete="off" id="owner-form">
                        <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Comments</label>
                            <textarea class="form-control" rows="6" name="comments"></textarea>
                        </div>
                        <div class="form-group col-md-2"></div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-8"></div>
                        <div class="form-group col-md-1">
                            <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                            <input type="text" name="action" value="ownership" style="display:none;"/>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="own_change">
                <form autocomplete="off" id="owner-change-form">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Select User </label>
                        <select class="form-control" name="type">
                            <option>Select Option</option>
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
                    <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Comments</label>
                        <textarea class="form-control" rows="6" name="comments"></textarea>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-md-8"></div>
                    <div class="form-group col-md-1">
                        <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                        <input type="text" name="action" value="ownchange" style="display:none;"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
        $("#comments-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#comments-form").serializeArray();
                    // console.log(data);
                    action_res('Comment Status',data,'','');
                });

          $("#review-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#review-form").serializeArray();
                    // console.log(data);
                    action_res('Review Status',data,'','');
                });


        $("#owner-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#owner-form").serializeArray();
                    // console.log(data);
                    action_res('Owner Status',data,'','');
                });
         $("#owner-change-form").submit(function(e){
                e.preventDefault();
                var data = $("#owner-change-form").serializeArray();
                // console.log(data);
                action_res('Owner Change Status',data,'','');
                });
        $("#reminder-form").submit(function(e){
                e.preventDefault();
                var data = $("#reminder-form").serializeArray();
                // console.log(data);
                action_res('Reminder Form Status',data,'','');
            });
        $("#chat-form").submit(function(e){
            e.preventDefault();
            var data = $("#chat-form").serializeArray();    
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
         

        </script>
    <?php
}else if ($action == 'view'){   
    $this->db->select("
        ps_leads.id as lead_id,
        ps_leads.expected_amount as amount,
        ps_customers.name,
        ps_customers.email,
        ps_customers.number
    ");
    $this->db->from("ps_leads");
    $this->db->join('ps_customers', 'ps_leads.id = ps_customers.lead_id');
    $this->db->where("ps_leads.id",$id);
    $this->db->order_by("ps_leads.id","desc"); 
    $queries = $this->db->get()->result();    
    ?>
        <table id="spndng_dtls" class="table table-striped table-hover table-sm table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Number</th>
                    <th>Expected Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1;
                foreach($queries as $query){?>
                <tr>
                    <td><?=$num?></td>
                    <td><?=$query->name;?></td>
                    <td><?=$query->email;?></td>
                    <td><?=$query->number;?></td>
                    <td><?=$query->amount;?></td>
                  
                </tr>

                <?php $num++; };?>
            </tbody>
        </table>

    <?php
}else if ($action == 'delete'){
    $this->db->select('
    ps_leads_history.*,
    ps_leads_status.name as status_name,
    ps_leads_status.status_btn,
    CONCAT(ps_user_profile.first_name,"-",ps_user_profile.last_name) as username 
    ');
    $this->db->from("ps_leads_history");
    $this->db->join('ps_leads_status', 'ps_leads_history.status = ps_leads_status.id');
    $this->db->join('ps_user_profile', 'ps_user_profile.fk_parent_id = ps_leads_history.user_id');
    $this->db->where("lead_id",$id);
    $queries = $this->db->get()->result();
    ?>

    <table id="spndng_dtls" class="table table-striped table-hover table-sm table-bordered">    
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Comment</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 0;
                foreach ($queries as $query) {
                    $status_btn = '<span class="badge '.$query->status_btn.' es-label">'.$query->status_name.'</span>';
                    ?>
                    <tr>
                        <td><?=++$count?></td>
                        <td><?=$query->username?></td>
                        <td><?=$query->comments?></td>
                        <?php 
                        if($query->file_path != ''){
                            ?>
                        <td><a class="badge badge-primary es-label" download href="<?=base_url()."". $query->file_path?>"  >download</a></td>
                        <?php
                            }else{
                                ?>
                                <td>No File Found</td>
                                <?php
                            }
                            ?>
                        <td><?=$status_btn?></td>
                        <td><?=$query->created_at?></td>
                    </tr>
                     <?php 
                }
                ?>
            </tbody>
    </table>

    <?php

}
?>
