<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Update Role</h5>
            </div>
            <div class="card-body">
              <form id="role-form-edit">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">


                    <input type="hidden" name="id" value="<?=$role[0]['id'] ?>" class="form-control shadow-sm p-3" placeholder="Team">

                    <div class="form-group">
                      <label>Role</label>
                      <input required type="text" name="name" value="<?=$role[0]['name']?>" class="form-control shadow-sm p-3" placeholder="Role Name">
                    </div>
                  </div>
                </div>  
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Department</label>
                      <select required name="depart_id" class="form-control shadow-sm p-3" id="">
                        <option value="">Select Team</option>
                       <?php
                          foreach($r_dep as $r_deps){
                        ?>

                           <option value="<?=$r_deps['id'];?>"<?php if($r_deps['id']==$role[0]['depart_id']) echo 'selected="selected"'; ?>><?=$r_deps['name'];?></option>
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
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Update Role</button>
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