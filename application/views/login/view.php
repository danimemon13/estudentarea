<style>
	.alert-danger{
		display: none;
	}
</style>
<body>
<div class="login_bg w-100">
	<div class="container-fluid">
		<div class="row ">
			<div class="col-xl-4 col-lg-4 col-md-8 col-sm-12 col-xs-12 p-0">
				<div class="login_left w-100">
					<div class="login_logo mb-4  text-center">
						<img src="<?=base_url()?>img/logo-full-blue.png" class="img-fluid w-75" alt="">
					</div>
					<div class="login_form w-100">
						<div class="alert alert-danger" role="alert">
						  <strong>Oh snap!</strong> 
						</div>					
						<form class="mt-4" id="login_form">
							<div class="form-group mb-4">
								<div class="input-group shadow">
								    <div class="input-group-prepend border-0">
								      <span class="input-group-text bg-white border-0 bg-transparent p-3"><i class="icofont-ui-user"></i></span>
								    </div>
								    <input type="text" name="user_name" required class="form-control bg-transparent border-0 border-left-0 p-3 h-auto" placeholder="Enter your username">
								</div>
							</div>
							<div class="form-group mb-4">
								<div class="input-group shadow">
								    <div class="input-group-prepend border-0">
								      <span class="input-group-text bg-white border-0 bg-transparent p-3"><i class="icofont-lock"></i></span>
								    </div>
								    <input type="password" name="password" required class="form-control bg-transparent border-0 border-left-0 p-3 h-auto" placeholder="Enter your password">
								</div>
							</div>
							<div class="form-group mb-4">
								<button class="modal_btn btn btn-block p-3 shadow">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-lg-8 col-md-4 col-sm-12 col-xs-12 p-0">
				<div class="login_right w-100">
					<p class="text-white">Copyright @ 2017 - 2020 - Online Learning | CRM</p>
				</div>
			</div>
		</div>
	</div>			
</div>


 