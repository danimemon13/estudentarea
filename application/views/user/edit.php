<?php
// print_r($userdetails);
// die();
// echo $userdetails[0]->id;
// die();
?>
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
</style>
<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Edit User Username is :  <?=$userdetails[0]->first_name_real."-".$userdetails[0]->last_name_real;?></h5>
            </div>
            <div class="card-body">
              <form id="user-edit-form">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" value="<?=$userdetails[0]->user_name;?>" name="user_name" class="form-control shadow-sm p-3" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" name="password" class="form-control shadow-sm p-3" placeholder="Password">
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>First Name</label>
                        <input type="text" value="<?=$userdetails[0]->first_name;?>" name="first_name" class="form-control shadow-sm p-3" placeholder="First Name" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" value="<?=$userdetails[0]->last_name;?>" name="last_name" class="form-control shadow-sm p-3" placeholder="Last Name" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>First Name (Real)</label>
                        <input type="text" value="<?=$userdetails[0]->first_name_real;?>" name="first_name_real" class="form-control shadow-sm p-3" placeholder="First Name (Real)" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Last Name (Real)</label>
                        <input type="text" value="<?=$userdetails[0]->last_name_real;?>" name="last_name_real" class="form-control shadow-sm p-3" placeholder="Last Name (Real)" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Employee Id</label>
                      <input type="text" name="employee_id" value="<?=$userdetails[0]->employee_id;?>" class="form-control shadow-sm p-3" placeholder="Employee Id" required>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Extension</label>
                      <input type="text" name="extension" value="<?=$userdetails[0]->extension;?>" class="form-control shadow-sm p-3" placeholder="Extension" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <label>Allow Ip</label>
                          <input type="checkbox" id="allow_ip" <?php echo $userdetails[0]->ip_allow == '1' ? 'checked' : 'unchecked';?> name="allow_ip" class="option-input checkbox">
                      <label>Status</label>
                          <input type="checkbox" id="status" <?php echo $userdetails[0]->status == '1' ? 'checked' : 'unchecked';?> name="status" class="option-input checkbox">
                    </div>
                </div>
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Team</label>
                      <select name="team" id="team" class="form-control shadow-sm p-3" onchange="getdatabyTeam(this.value,'ps_department','fk_team_id','departmentDiv')" required>
                        <option value="">Select Team</option>
                        <?php
                          foreach($team as $teams){
                        ?>
                        <option value="<?=$teams['id'];?>"<?php if($teams['id']==$userdetails[0]->team) echo 'selected="selected"'; ?>><?=$teams['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Department</label>
                      <select name="department" id="departmentDiv" class="form-control shadow-sm p-3 dropdowns"  required>
                        <option value="">Select Department</option>
                        <?php
                          foreach($dep as $deps){
                        ?>
                          <option value="<?=$deps['id'];?>"<?php if($deps['id']==$userdetails[0]->department) echo 'selected="selected"'; ?>><?=$deps['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Role</label>
                      <select name="role" id="role" class="form-control shadow-sm p-3 dropdowns" onchange="check_role1()" required>
                        <option value="">Select Role</option>
                            <?php
                            foreach($role as $roles){
                            ?>
                            <option value="<?=$roles['id'];?>"<?php if($roles['id']==$userdetails[0]->role) echo 'selected="selected"'; ?>><?=$roles['name'];?></option>
                            <?php
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group" id="dynamic_team_leads">
                         <input name='team_leads' type='hidden' value='<?=$userdetails[0]->team_lead?>'>
                      </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group" id="dynamic_managers">
                    <input name='manager' type='hidden' value='<?=$userdetails[0]->manager?>'>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="user_id" value="<?=$userdetails[0]->id;?>">
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Update User</button >
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