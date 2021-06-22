
<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Update Department</h5>
            </div>
            <div class="card-body">
              <form id="dep-form-edit">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                     <input type="hidden" name="id" value="<?=$dep_id[0]['id'] ?>" class="form-control shadow-sm p-3" placeholder="Team">

                    <div class="form-group">
                      <label>Department</label>

                      <input required type="text" name="name"  value="<?=$dep_id[0]['name'] ?>" class="form-control shadow-sm p-3" placeholder="Department Name">
                    </div>
                  </div>
                </div>          
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Team</label>
                      <select name="fk_team_id" id="fk_team_id" class="form-control shadow-sm p-3" required>
                        <option value="">Select Team</option>
                        <?php
                          foreach($team as $teams){
                        ?>
                          <option value="<?=$teams['id'];?>"<?php if($teams['id']==$dep_id[0]['fk_team_id']) echo 'selected="selected"'; ?>><?=$teams['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>


                    </div>
                  </div>
                </div>          
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Update Department</button>
                    </div>
                  </div>
                </div>          
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>