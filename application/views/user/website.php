

<div class="main_content w-100" style='height: 100vh;'>
  <div class="container-fluid">

                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
               <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
            
            <li class="nav-item">
                <a class="nav-link active" id="Assign-Website" title="com" data-toggle="tab" href="#team_change" role="tab" aria-controls="home5" aria-selected="true">Assign Website</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="review-stats" data-toggle="tab" href="#type_change" role="tab" aria-controls="contact5" aria-selected="false">Remove Website</a>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" id="contact-tab" title="add-chat" data-toggle="tab" href="#status_change" role="tab" aria-controls="contact5" aria-selected="false">Change Status</a>
            </li> -->
        
        
    </ul>


</div>
                    </div>
                  </div>
           <style type="text/css">
             .multiselect-container{
              width: 100%;
              
             }
           </style>       
              
<div class="tab-content" id="myTabContent" style="border: 1px solid #dddddd;">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="home-tab" id="team_change" >
                <form autocomplete="off" id="assign-web">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                       <input type="hidden" name="id" value="<?=$id?>" class="form-control shadow-sm p-3" placeholder="Team">
                        <label for="lead_code" class="col-form-label">Assign Website</label>
                        <select id="name" name="name[]" class=" form-control" multiple >
                           
                            <?php
                            foreach($website as $websites){
                            ?>
                            <option value="<?=$websites['id']?>"><?=$websites['name']?></option>
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
                         <br><br><br><br>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>

                    </div>
                    <div class="form-group col-md-2"></div>

                    </div>
                </form>
            </div>
            <div class="tab-pane fade" role="tabpanel" aria-labelledby="home-tab" id="type_change" >
           <form autocomplete="off" id="remove_web">
                    <div class="form-row">
                    <div class="form-group col-md-2"></div>
                    <div class="form-group col-md-8">
                       <input type="hidden" name="id" value="<?=$id?>" class="form-control shadow-sm p-3" placeholder="Team">
                        <label for="lead_code" class="col-form-label">Remove Website</label>
                        <select id="name2" name="name[]" class=" form-control" multiple >
                            <?php
                            foreach($website as $websites){
                            ?>
                            <option value="<?=$websites['id']?>"><?=$websites['name']?></option>
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
                           <br><br><br><br>
                        <button type="submit" class="pull-right btn btn-primary btn-block">Save</button>
                    </div>
                    <div class="form-group col-md-2"></div>
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




                </div> 



    
  </div>