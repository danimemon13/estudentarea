<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Add New Lead</h5>
            </div>
            <div class="card-body">
              <form id="lead-form">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer_name" class="form-control shadow-sm p-3" placeholder="Enter Customer Name" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Customer Email</label>
                      <input type="text" name="customer_email" class="form-control shadow-sm p-3" placeholder="Enter Customer Email" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Customer Phone</label>
                        <input type="text" name="customer_phone" class="form-control shadow-sm p-3" placeholder="Enter Customer Phone" required>
                      </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    <div class="form-group">
                      <label>Select Website</label>
                      <select name="website" id="website" class="form-control shadow-sm p-3 " required>
                        <option value="">Select Website</option>
                        <?php
                          foreach($websites as $website){
                        ?>
                          <option value="<?=$website['id'];?>"><?=$website['name'];?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Expected Amount</label>
                        <input type="number" name="expected_amount" class="form-control shadow-sm p-3" placeholder="Enter Amount" required>
                      </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-6 col-md-12 col-sm-12">
                    <textarea class="form-control shadow-sm p-3 " placeholder="Enter Your Comments" name="comments" id="comments" cols="30" rows="10"></textarea> 
                  </div>
                </div>
                <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                        <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Add Lead</button >
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