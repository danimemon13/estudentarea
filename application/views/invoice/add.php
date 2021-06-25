<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">
          <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
            <div class="card-header border-0 text-white pt-3 pb-3">
              <h5 class="text-uppercase font-weight-bold">Add New Invoice</h5>
            </div>
            <div class="card-body">
              <form id="get-lead-detail">
              <div class="row">
                  <input type="hidden" id="id" name="id" class="form-control shadow-sm p-3" placeholder="Lead Code" >
                   <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                       <div class="form-group">
                       <label>Enter Lead Code</label>
                        <input required type="text" id="lead_code" name="lead_id" class="form-control shadow-sm p-3" placeholder="Lead Code" >
                        </div> 
                    </div>
                      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label>Get Lead Details</label>
                       <input type="text" name="id" value="" style="display:none;"/>
                        <button type="button" class="pull-right btn btn-success btn-block" onclick="get_lead()">Get Lead Code</button>
                    </div>
                  </div>
                </div>  
                 <div class="row">
                  <input type="hidden" id="c-id" name="lead_id" class="form-control shadow-sm p-3" placeholder="Customer Name" required>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Customer Name</label>
                        <input readonly type="text" id="c-name" name="name" class="form-control shadow-sm p-3" placeholder="Customer Name" required>
                      </div>
                    </div>
                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Customer Email</label>
                        <input readonly type="text" id="c-email" name="email" class="form-control shadow-sm p-3" placeholder="Customer Email" required>
                      </div>
                    </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Customer Contact No</label>
                        <input readonly type="text" id="c-contact-no" name="number" class="form-control shadow-sm p-3" placeholder="Customer Contact No" required>
                      </div>
                    </div>
                         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>User Name</label>
                        <input readonly type="text" name="u-name"  class="form-control shadow-sm p-3" value="<?=$first_name.".".$last_name?>" placeholder="User Name" required>
                      </div>
                    </div>
                      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Amount</label>
                        <input type="text"  name="amount" class="form-control shadow-sm p-3" placeholder="Customer Amount" required>
                      </div>
                    </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Select Curency</label>
                        <select name="currency" id="currency" class="form-control shadow-sm p-3" required="">
                             <option value="">Select Currency</option>
                             <option value="CAD">CAD</option>
                             <option value="GBP">GBP</option>
                             <option value="USD">USD</option>
                             <option value="AUD">AUD</option>
                             <option value="EUR">EUR</option>
                             <option value="GBP">GBP</option>
                           </select>
                      </div>
                    </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                        <label>Select Website</label>
                        <select required name="website" class="form-control shadow-sm p-3" id="">
                            <option value="">Select website</option>
                            <?php 
                            foreach($website as $websites){
                            ?>
                            <option value="<?=$websites['id']?>"><?=$websites['name']?></option>
                            <?php
                            }
                            ?>
                       </select>
                      </div>
                      </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-md-12"></div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 ">
                              <table class="table table-striped">
                                <thead id="multiChoose">
                                <tr class="table table-secondary">
                                  <th>Service</th>        
                                  <th>Comments</th>
                                  <th>Action</th>
                                </tr>
                                 <tr class="table table-primary">
                                  <td>
                                   <select required name="service_id[]" class="form-control shadow-sm p-3" id="service">
                                    <option value="">Select Services</option>
                                    <?php 
                                    foreach($service as $services){
                                    ?>
                                    <option value="<?=$services['id']?>"><?=$services['name']?></option>
                                    <?php
                                    }
                                    ?>
                                   </select>
                                    </td>
                                    <td>
                                      <textarea class="form-control form_text" name="comments[]" id="comments" placeholder="Any additional comments / special instructions?"></textarea>
                                    </td>
                                    <td><button class="btn btn-success addToList" id="btnAdd">ADD</button></td>
                                  </tr>
                                </thead>
                                  <tbody class="insertItems table table-hover">
                                  </tbody>
                              </table>
                            </div>
                        </div>  
                 <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="form-group">
                       <button type="submit" name="add_team" class="w-100 btn btn-primary shadow-sm p-3">Add Invoice</button>
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