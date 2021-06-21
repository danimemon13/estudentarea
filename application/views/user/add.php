<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Add New User</h5>
            </div>
            <div class="card-body">
              <form id="user-form">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="user_name" class="form-control shadow-sm p-3" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control shadow-sm p-3" placeholder="Password" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control shadow-sm p-3" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" name="last_name" class="form-control shadow-sm p-3" placeholder="Last Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>First Name (Real)</label>
                        <input type="text" name="first_name_real" class="form-control shadow-sm p-3" placeholder="First Name (Real)" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Last Name (Real)</label>
                        <input type="text" name="last_name_real" class="form-control shadow-sm p-3" placeholder="Last Name (Real)" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Employee Id</label>
                        <input type="text" name="employee_id" class="form-control shadow-sm p-3" placeholder="Employee Id" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Extension</label>
                        <input type="text" name="extension" class="form-control shadow-sm p-3" placeholder="Extension" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Team</label>
                      <select name="team" id="team" class="form-control shadow-sm p-3 " onchange="getdatabyTeam(this.value,'ps_department','fk_team_id','departmentDiv')" required>
                        <?php
                          foreach($team as $teams){
                        ?>
                          <option value="<?=$teams['id'];?>"><?=$teams['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Department</label>
                      <select name="department" id="departmentDiv" class="form-control shadow-sm p-3 dropdowns" onchange="getdatabyTeam(this.value,'ps_role','depart_id','roleDiv')" required>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Role</label>
                      <select name="role" id="roleDiv" class="form-control shadow-sm p-3 dropdowns" required>

                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Add Team</button >
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