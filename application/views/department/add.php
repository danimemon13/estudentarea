<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Add New Department</h5>
            </div>
            <div class="card-body">
              <form id="department-form">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Department</label>
                      <input required type="text" name="name" class="form-control shadow-sm p-3" placeholder="Department Name">
                    </div>
                  </div>
                </div>          
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Team</label>
                      <select required name="fk_team_id" class="form-control shadow-sm p-3" id="">
                        <option value="">Select Team</option>
                        <?php 
                        foreach($team as $teams){
                        ?>
                        <option value="<?=$teams['id']?>"><?=$teams['name']?></option>
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
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Add Team</button>
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