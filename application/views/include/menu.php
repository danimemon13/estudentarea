<div class="main_header pr-3 pl-3 w-100 bg-white fixed-top shadow-sm py-1">
      <div class="header_nav w-100">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <ul class="header_nav_list mt-1">
                    <li class="nav-item list-unstyled d-inline-block">
                        <button class="btn btn-outline-primary sidebar_icon mr-2"><i class="icofont-navigation-menu"></i></button>
                    </li>
                    <li class="nav-item list-unstyled d-inline-block">
                      <div class="logo pr-2">
                        <a href="dashboard.php"><img src="<?=base_url()?>img/logo-full-blue.png" id="logo" alt="" class="img-fluid"></a>
                      </div>
                    </li>
                </ul>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <ul class="header_nav_profile text-right mt-sm-2">
                    <li class="list-unstyled d-inline-block">
                        <div class="dropdown bell-dropdown">
                            <a class="bell-btn dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i><span class="notify" id="notif-show">15</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </li>
                    <li class="list-unstyled d-inline-block">
                        <div class="dropdown">
                          <a class="nav-link dropdown-toggle p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?=base_url()?>img/profile_img.png" alt="" class="mr-2"><?=$full_name?> <span class="ml-2"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="profile.php"><span class="mr-2"><i class="icofont-ui-user"></i></span>Profile</a>
                            <a class="dropdown-item" href="#"><span class="mr-2"><i class="icofont-tools"></i></span>Developer Support</a>
                            <a class="dropdown-item" href="#"><span class="mr-2"><i class="icofont-refresh"></i></span>Dark Mode</a>
                            <a class="dropdown-item" href="<?=base_url()?>logout"><span class="mr-2"><i class="icofont-logout"></i></span>Logout</a>
                          </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
      </div>
      <div class="sidebar_nav shadow-sm">
        <ul class="list-group m-0 p-0">
            <?=$menu;?>
        </ul>
        
      </div>
</div>