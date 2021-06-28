<style>

@keyframes click-wave {
  0% {
    height: 40px;
    width: 40px;
    opacity: 0.35;
    position: relative;
  }
  100% {
    height: 200px;
    width: 200px;
    margin-left: -80px;
    margin-top: -80px;
    opacity: 0;
  }
}
.option-input {
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  -o-appearance: none;
  appearance: none;
  position: relative;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  height: 40px;
  width: 40px;
  transition: all 0.15s ease-out 0s;
  background: #cbd1d8;
  border: none;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 0.5rem;
  outline: none;
  position: relative;
  z-index: 1000;
}
.option-input:hover {
  background: #9faab7;
}
.option-input:checked {
  background: #007bff;
}
.option-input:checked::before {
  height: 40px;
  width: 40px;
  position: absolute;
  content: '✔';
  display: inline-block;
  font-size: 26.66667px;
  text-align: center;
  line-height: 40px;
}
.option-input:checked::after {
  -webkit-animation: click-wave 0.65s;
  -moz-animation: click-wave 0.65s;
  animation: click-wave 0.65s;
  background: #007bff;
  content: '';
  display: block;
  position: relative;
  z-index: 100;
}
.option-input.radio {
  border-radius: 50%;
}
.option-input.radio::after {
  border-radius: 50%;
}
form#user-form button {
    margin-top: 20px;
}

</style>
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
                      <label>Allow Ip</label>
                      <div>
                          <input type="checkbox" id="allow_ip" name="allow_ip" class="option-input checkbox">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Select Team</label>
                        <select name="team" id="team" class="form-control shadow-sm p-3 " onchange="getdatabyTeam(this.value,'ps_department','fk_team_id','departmentDiv')" required>
                          <option value="">Select Team</option>
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
                        <option value="">Select Department</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Role</label>
                      <select name="role" id="role" class="form-control shadow-sm p-3 " onchange="check_role1()" required>
                      <!-- <select name="role" id="role" class="form-control shadow-sm p-3 " onchange="check_role(this.value)" required> -->
                        <option value="">Select Role</option>
                        <?php
                          foreach($role as $roles){
                        ?>
                          <option value="<?=$roles['id'];?>"><?=$roles['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group" id="dynamic_team_leads">
                      
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group" id="dynamic_managers">
                      
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