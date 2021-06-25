<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Add New Website</h5>
            </div>
            <div class="card-body">
              <form id="website-form">
              <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Enter Url (with www)</label>
                        <input type="text" name="name" class="form-control shadow-sm p-3" placeholder="Enter Url" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Discriptor</label>
                      <input type="text" name="descriptor" class="form-control shadow-sm p-3" placeholder="Enter Discriptor" required>
                    </div>
                  </div>
                </div>  
                 <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Website Type</label>

                      <select required name="type" class="form-control shadow-sm p-3" id="">
                        <option value="">Select Website Type</option>
                        <option value="SEO">SEO</option>
                         <option value="PPC">PPC</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Team</label>
                  
                       <select required name="team" class="form-control shadow-sm p-3" id="">
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
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Logo</label>
                      <input type="File" name="logo" class="form-control shadow-sm p-3" placeholder="" required>
                    </div>
                  </div>
                </div>          
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Add Team</button>
                        <!-- <button class="modal_btn btn btn-block p-3 shadow">Login</button> -->
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