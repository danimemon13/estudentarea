
<div class="main_content w-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 offset-xl-3 offset-lg-3">
        <div class="dash_head_tabs w-100 mt-3 text-center">
          <ul class="nav nav-tabs d-flex border-0" id="myTab" role="tablist">
            <li class="nav-item flex-fill" role="presentation">
              <a class="nav-link active" id="allteam-tab" data-toggle="tab" href="#allleads" role="tab" aria-controls="allleads" aria-selected="true">All Teams</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
      <div class="row">
        <div class="tab-content w-100 mt-3" id="myTabContent">
          <div class="tab-pane fade show active" id="allleads" role="tabpanel" aria-labelledby="allleads">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <form class="mt-3 p-3 shadow-sm table_filtr">
                <div class="row">
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <select class="form-control shadow-sm p-3">
                        <option>Select Website</option>
                      </select>
                    </div>
                  </div>
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <select class="form-control shadow-sm p-3">
                        <option>Select Website</option>
                      </select>
                    </div>
                  </div>
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <select class="form-control shadow-sm p-3">
                        <option>Select Website</option>
                      </select>
                    </div>
                  </div>
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <input type="date" class="form-control shadow-sm p-3" name="" placeholder="Start Date">
                    </div>
                  </div>
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <input type="date" class="form-control shadow-sm p-3" name="" placeholder="Start Date">
                    </div>
                  </div>
                  <div class="co-xl-2 col-lg-2 col-md-6 col-sm-12">
                    <div class="form-group mb-lg-0">
                      <button type="button" class="btn btn-danger btn-sm p-3 btn-block">Delete Selected leads</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>      
            <div class="col-xl-12 col-lg-12 col-md-12 col-md-12">        
              <div class="card shadow-sm border-0 mb-4 innr_pge_card mt-3">
                <div class="card-header border-0 text-white pt-3 pb-3">
                  <div class="row">
                    <div class="col-md-3">
                      <h5 class="text-uppercase font-weight-bold">Leads Table</h5>
                    </div>
                    <div class="col-md-8"></div>
                    <div class="col-md-1">
                      <button type="button" class="btn btn-primary btn-sm p-3">Add Team</button>
                    </div>
                  </div>
                  
                  
                </div>
                <div class="card-body table-responsive">
                  <table id="data-table1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($team as $teams){

                        ?>
                        <tr>
                            <td><?=$teams['id']?></td>
                            <td><?=$teams['name']?></td>
                            <td>
                              <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#leads_action"><span><i class="icofont-ui-edit"></i></span></button>
                              <button class="btn btn-sm btn-danger"><span><i class="icofont-ui-delete"></i></span></button>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>                                   
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="tab-pane fade show" id="myleads" role="tabpanel" aria-labelledby="myleads">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <h1>2</h1>
            </div>
          </div>
          <div class="tab-pane fade show" id="taleads" role="tabpanel" aria-labelledby="taleads">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <h1>3</h1>
            </div>
          </div>
          <div class="tab-pane fade show" id="tbleads" role="tabpanel" aria-labelledby="tbleads">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <h1>4</h1>
            </div>
          </div>
          <div class="tab-pane fade show" id="tcleads" role="tabpanel" aria-labelledby="tcleads">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
              <h1>5</h1>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
</div>