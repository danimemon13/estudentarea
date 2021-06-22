<?php
$team_lead_id = $team_lead_id;
$arr1['fk_parent_id'] =  $team_lead_id;
$get_team_lead = $this->Home_models->selectrecords('ps_user_profile',$arr1);
$arr['team'] = $get_team_lead[0]['team'];
//Manager = 1
if($get_team_lead[0]['role'] == '1'){
  $arr['role'] = '2';
  $parent_name = 'Manger';
  $action = 'update_manager';
//Team Lead = 2
}if($get_team_lead[0]['role'] == '2'){
  $arr['role'] = '3';
  $parent_name = 'Team Lead';
  $action = 'update_team_lead';
}
$get_users = $this->Home_models->selectrecords('ps_user_profile',$arr);





$team_lead_name = $get_team_lead[0]['first_name']." - ". $get_team_lead[0]['last_name'];
$team_lead_name;
// $arr['team_lead!='] = $team_lead_id;

?>
<style>
.multiselect-container {
        width: 100% !important;
}
.multiselect-container li:nth-child(1) {
    width: 100% !important;
}
.multiselect-container li:nth-child(2) {
    width: 100% !important;
}
.multiselect-container li {
    width: 25% !important;
    float:left;
}
.card-body .row {
    margin-top: 30px;
}
</style>
<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Assign User To : <span id="team_lead_name"><?=$team_lead_name?></span> </h5>
            </div>
            <div class="card-body">
            <input type="hidden" id='team_lead' value="<?=$team_lead_id?>">
            <input type="hidden" id='action' value="<?=$action?>">
              <div class="row" style="margin-top: 0px !important;">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <select name="user[]" multiple id="mandator_select">
                      <?php
                        foreach($get_users as $user){
                          $userid = $user['fk_parent_id'];
                          $username = $user['first_name']."".$user['last_name'];
                          echo '<option value='.$userid.'>'.$username.'</option>';
                        }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <!-- <div class="numberselected form-control shadow-sm p-3" id="numberselected">
                    </div> -->
                    <table class="table table-hover">
                        <tr>
                          <th><?=$parent_name?></th>
                          <th>UserName</th>
                        </tr>
                        <tbody id='numberselected'>
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" onclick="user_assign()" class="w-100 btn btn-primary shadow-sm p-3">Update User</button >
                    </div>
                  </div>
                </div>     
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

