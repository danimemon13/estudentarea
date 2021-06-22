<?php 
$action = $_POST['action'];
$id = $_POST['id'];
if($action == 'edit'){
    ?>
    <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
            
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" title="com" data-toggle="tab" href="#team_change" role="tab" aria-controls="home5" aria-selected="true">Change Team</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="review-stats" data-toggle="tab" href="#type_change" role="tab" aria-controls="contact5" aria-selected="false">Change Type</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="add-chat" data-toggle="tab" href="#status_change" role="tab" aria-controls="contact5" aria-selected="false">Change Status</a>
            </li>
        
        
    </ul>
    <div class="tab-content" id="myTabContent" style="border: 1px solid #dddddd;">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="team_change" >
                <form autocomplete="off" id="team-form">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <label for="lead_code" class="col-form-label">Change Team Name</label>
                        <select required class="form-control" name="team">
                            <option value="">Select Team </option>
                            <?php
                            foreach($team as $teams){
                            ?>
                            <option value="<?=$teams['id']?>"><?=$teams['name']?></option>
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
                        <input type="text" name="id" value="<?=$id?>" style="display:none;"/>
                        <input type="text" name="action" value="change_team" style="display:none;"/>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                    <div class="form-group col-md-2"></div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="type_change" >
                <form autocomplete="off" id="type-form">
                    <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Website Type</label>
                            <select required class="form-control" name="type">
                                <option value="">Select Type</option>
                                <option value="SEO">SEO</option>
                                <option value="PPC">PPC</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2"></div>
                    </div>
                 
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                        <input type="text" name="action" value="change_type" style="display:none;"/>
                        <button type="submit"  class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="status_change">
                <form autocomplete="off" id="status-form">
               
                       <div class="form-row">
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-8">
                            <label for="lead_code" class="col-form-label">Change Status</label>
                            <select required class="form-control" name="status">
                                <option value="">Change Status</option>
                                <option value="1">Active</option>
                                <option value="0">InActive</option>
                            </select>
                        </div>
                       
                    </div>
  
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                        <input type="text" name="id" value="<?=$id;?>" style="display:none;"/>
                        <input type="text" name="action" value="change_status" style="display:none;"/>
                        
                        <button type="submit"  class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                    </div>
                </form>
            </div>
            
        </div>
        <script>
        $("#team-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#team-form").serializeArray();
                    // console.log(data);
                    action_res('Change Team',data,'','');
                });

          $("#type-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#type-form").serializeArray();
                    // console.log(data);
                    action_res('Change Type',data,'','');
                });


        $("#status-form").submit(function(e){
                    e.preventDefault();
                    var data = $("#status-form").serializeArray();
                    // console.log(data);
                    action_res('Change Status',data,'','');
                });
    
         

        </script>
    <?php
}else if ($action == 'view'){
    echo "this is view".$id;
}
?>