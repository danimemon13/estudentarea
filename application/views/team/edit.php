<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Update Team</h5>
            </div>
            <div class="card-body">
              <form id="team-form-edit">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Team</label>
                      <input type="hidden" name="id" value="<?=$team_id[0]['id']?>" class="form-control shadow-sm p-3" placeholder="Team">

                      <input type="text" required name="name" value="<?=$team_id[0]['name']?>" class="form-control shadow-sm p-3" placeholder="Team">
                    </div>
                  </div>
                </div>          
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Update Team</button>
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