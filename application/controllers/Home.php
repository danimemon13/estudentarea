<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');    
		$this->load->library('zip');    
    }

    public function login(){
    	if ( $this->session->userdata('is_login'))
       	{
             //redirect in login
            redirect('dashboard', 'refresh');
       	}
    	$this->load->template('login/view','',1);

    	$this->load->view('login/function');
    }
    public function login_user(){
	
		$username = $_POST['user_name'];
		$password = md5($_POST['password']);
		
		$userArray = array('user_name' => $username, 'password' => $password);
	
		$data['login'] = $this->Home_models->selectrecords('ps_user_login',$userArray);
		// echo $this->db->last_query();
		// die();
		$return_arr = array();

		if(!empty($data['login'])){
			//success
			$return_arr[] = array("Type" => "Success","Error_type" => "login","msg"=>"User Is Available");
			$fk_id = $data['login'][0]['id'];
			$array = array('fk_parent_id'=>$fk_id);
			$data['profile'] = $this->Home_models->selectrecords('ps_user_profile',$array);
		
			$this->session->set_userdata("user_basis",$data['login']);
			$this->session->set_userdata("user_profile",$data['profile']);
			$this->session->set_userdata("is_login","1");
			
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Logged in";
			$this->create_logs('Login Area',$message);
		}
		else{
			$return_arr[] = array("Type" => "Error","Error_type" => "login","msg"=>"Invalid User Name or Password");
		}


    	
    	echo json_encode($return_arr);
    }
    public function dashboard(){
    	$data['menu'] = $this->MenuModel->category_menu(1);
    	$this->load->template('dashboard/view',$data);
    }
    public function index(){
    	//$this->load->view('import');
    	if ( $this->session->userdata('is_login'))
       	{
             //redirect in login
            redirect('dashboard', 'refresh');
       	}
    	$this->load->template('login/view','',1);

    	$this->load->view('login/function');
    }
    public function importFile(){
    	$inserdata = array();
    	if ($this->input->post('submit')) {
		$path = 'uploads/';
		require_once APPPATH . "/third_party/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);            
		if (!$this->upload->do_upload('uploadFile')) {
		$error = array('error' => $this->upload->display_errors());
		} else {
		$data = array('upload_data' => $this->upload->data());
		}
		if(empty($error)){
		if (!empty($data['upload_data']['file_name'])) {
		$import_xls_file = $data['upload_data']['file_name'];
		} else {
		$import_xls_file = 0;
		}
		$inputFileName = $path . $import_xls_file;
		try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
		$flag = true;
		$i=0;
		foreach ($allDataInSheet as $value) {
		
		$inserdata[$i]['first_name'] = $value['A'];
		$inserdata[$i]['last_name'] = $value['B'];
		$inserdata[$i]['email'] = $value['C'];
		$inserdata[$i]['contact_no'] = $value['D'];
		$i++;
		}    
		print_r($inserdata);           
		/*$result = $this->import->insert($inserdata);   
		if($result){
		echo "Imported successfully";
		}else{
		echo "ERROR !";
		} */            
		} catch (Exception $e) {
		die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
		. '": ' .$e->getMessage());
		}
		}else{
		echo $error['error'];
		}
		}
		$this->load->view('import');
    }
    public function logout(){
    	$this->session->unset_userdata('is_login');
		$this->session->sess_destroy();
		redirect('home', 'refresh');
    }
    function api_index()
	 {

	  //$data = $this->api_model->fetch_all();
	 	print_r($_POST);
	  //echo json_encode($this->input->post());
	 }
    public function index_post(){
    	$api_url = "http://localhost/estudentarea/dynamic/home/api_index";
    	$form_data = array(
	     'id'  => 10
	    );

	    $client = curl_init($api_url);

	    curl_setopt($client, CURLOPT_POST, true);

	    curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);

	    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

	    $response = curl_exec($client);

	    curl_close($client);

	    echo $response;

    }
    /************** Global Function ******************/
	public function getallData(){
        $ID = $_POST["ID"];
		$table = $_POST["table"];
		$column = $_POST['column'];
		$array = array($column=>$ID);
        $data['data'] = $this->Home_models->selectrecords($table,$array);
        echo json_encode($data['data']);
		// echo $this->db->last_query();
    }
	public function create_logs($area,$action){
		$ip = $_SERVER['REMOTE_ADDR'];
		$array = array(
			'user_id'=>$_SESSION['user_profile'][0]['fk_parent_id'],
			'area'	=>$area,
			'action'=>$action,
			'ip'	=>$ip
		);
		$add_logs = $this->Home_models->saverecords('ps_logs',$array);

	}
	public function getDetilsById($column,$id,$table){
		$array = array($column=>$id);
        return $this->Home_models->selectrecords($table,$array);
	}
	public function getMangersAndTeamLeads(){
		// print_r($_POST);
		// die();
        $dep  = $_POST["department"];
        $team = $_POST["team"];
        $role = $_POST["role"];
		$array = array('team'=>$team,'department'=>$dep,'role'=>$role);
        $data['data'] = $this->Home_models->selectrecords('ps_user_profile',$array);
        echo json_encode($data['data']);
		// echo $this->db->last_query();
    }
	
	

	/************** Department ******************/
	public function department(){
		$data['department'] = $this->Home_models->selectrecords('ps_department');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('department/index',$data);
		$this->load->view('department/_js');
	}
	public function department_response(){
		  $draw = intval($this->input->get("draw"));
	      $start = intval($this->input->get("start"));
	      $length = intval($this->input->get("length"));
		  $this->db->select("ps_department.id ,ps_team.name,ps_department.name as depart");
	      $this->db->from("ps_team");
		  $this->db->join('ps_department', 'ps_team.id = ps_department.fk_team_id');
	      $this->db->order_by("ps_department.id","desc"); 
	      $query = $this->db->get();
      
      $data = [];

      $count=0;     
      foreach($query->result() as $r) {
      		$btn  = '<a href="'.base_url().'department/edit/'.$r->id.'" class="btn btn-warning btn-icon">';
      		$btn .= '<i class="fa fa-eye"></i>';
      		$btn .= '</a>';
      		$btn  .= '<button onClick="delete_func(this.id,\'team\')" id="'.$r->id.'" class="btn btn-danger btn-icon">';
      		$btn .= '<i class="fa fa-trash"></i>';
      		$btn .= '</button>';
            $data[] = array(
                ++$count,
                $r->depart,
                $r->name,
                $btn
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
    } 
	public function department_add(){
		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('department/add',$data);
    	$this->load->view('department/_js');
	}
	public function deparment_add_response(){
		$array = $_POST;
		$addepartment = $this->Home_models->saverecords('ps_department',$array);
		$return_arr = array();
		if($addepartment>0){
			
			$return_arr[] = array("Type" => "Success","Error_type" => "department","msg"=>"Data Success Fully Inserted");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
    }
    public function department_edit($id = null){
    	$data['menu'] = $this->MenuModel->category_menu(1);
    	$data['team'] = $this->Home_models->selectrecords('ps_team');
		$userArray = array('id' => $id);
		$data['dep_id'] = $this->Home_models->selectrecords('ps_department',$userArray);

		$this->load->template('department/edit',$data);
    	$this->load->view('department/_js');

	}
	public function department_edit_response(){	
		$id= $this->input->post('id');
		$editData['name'] = $this->input->post('name');
		$editData['fk_team_id'] = $this->input->post('fk_team_id');
		$update = $this->Home_models->update_department($editData, $id);
		$return_arr = array();
		if($update>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "Department","msg"=>"Data Success Fully Updated");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Department","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
    }



	/************** Team ******************/
	public function team(){
		$data['menu'] = $this->MenuModel->category_menu(1);

		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$this->load->template('team/index',$data);
		$this->load->view('team/_js');
	}
	public function team_response(){
	  $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));
      $this->db->select("*");
      $this->db->from("ps_team");
      $this->db->order_by("id","desc"); 
      $query = $this->db->get();
      
      $data = [];

      $count=0;     
      foreach($query->result() as $r) {
			$btn  = '<a href="'.base_url().'team/edit/'.$r->id.'" class="btn btn-warning btn-icon">';
			$btn .= '<i class="fa fa-eye"></i>';
			$btn .= '</a>';
			$btn  .= '<button onClick="delete_func(this.id,\'team\')" id="'.$r->id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
			$btn .= '</button>';
           $data[] = array(
                ++$count,
                $r->name,
                $btn
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
    }
	public function team_add(){
		$data['menu'] = $this->MenuModel->category_menu(1);

		$this->load->template('team/add',$data);
    	$this->load->view('team/_js');
	}
	public function team_add_response(){
		$array = $_POST;
		$addepartment = $this->Home_models->saverecords('ps_team',$array);
		$return_arr = array();
		if($addepartment>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "department","msg"=>"Data Success Fully Inserted");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
    }
	public function team_edit($id = null){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$userArray = array('id' => $id);
		$data['team_id'] = $this->Home_models->selectrecords('ps_team',$userArray);
		$this->load->template('team/edit',$data);
    	$this->load->view('team/_js');
	}
	public function team_edit_response() {
		$id = $this->input->post('id');
		$editData['name'] = $this->input-> post('name');
		$update = $this->Home_models->update_team($editData, $id);
		$return_arr = array();
		if ($update > 0) {
			$return_arr[] = array("Type" => "Success", "Error_type" => "Team", "msg" => "Data Success Fully Updated");
		} else {
			$return_arr[] = array("Type" => "Error", "Error_type" => "Team", "msg" => "Server Error");
		}
		echo json_encode($return_arr);
	}


	/************** Role ******************/
	public function role(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('role/index',$data);
		$this->load->view('role/_js');
	}
	public function role_response(){
	  $draw 	= intval($this->input->get("draw"));
      $start 	= intval($this->input->get("start"));
      $length 	= intval($this->input->get("length"));
      $this->db->select("ps_role.id,ps_role.name,ps_department.name as depart");
      $this->db->from("ps_role");
	  $this->db->join('ps_department', 'ps_role.depart_id = ps_department.id');
      $this->db->order_by("ps_role.id","desc");
      $query = $this->db->get();
      $data = [];

      $count=0;     
      foreach($query->result() as $r) {
      		$btn  = '<a href="'.base_url().'role/edit/'.$r->id.'" class="btn btn-warning btn-icon">';
      		$btn .= '<i class="fa fa-eye"></i>';
      		$btn .= '</a>';
      		$btn  .= '<button onClick="delete_func(this.id,\'role\')" id="'.$r->id.'" class="btn btn-danger btn-icon">';
      		$btn .= '<i class="fa fa-trash"></i>';
      		$btn .= '</button>';
           $data[] = array(
                ++$count,
                $r->name,
                $r->depart,
                $btn
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
    }
	public function role_add(){
		$data['dep'] = $this->Home_models->selectrecords('ps_department');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('role/add',$data);
    	$this->load->view('role/_js');
	}
	public function role_add_response(){
		$array = $_POST;
		$adderole = $this->Home_models->saverecords('ps_role',$array);
		$return_arr = array();
		if($adderole>0){
			$data['menu'] = $this->Home_models->selectrecords('ps_menu');
			foreach($data['menu'] as $menu){
				$menu_id = $menu['id'];
				$array = array('role_id'=>$adderole,'menu_id'=>$menu_id,'add_acces'=>0,'edit_access'=>0,'delete_access'=>0,'view_access'=>0);
				$this->Home_models->saverecords('ps_menu_access',$array);
			
			}
			$return_arr[] = array("Type" => "Success","Error_type" => "department","msg"=>"Data Success Fully Inserted");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
    }
	public function role_edit($id = null){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$data['r_dep'] = $this->Home_models->selectrecords('ps_department');
		$userArray = array('id' => $id);
		$data['role'] = $this->Home_models->selectrecords('ps_role',$userArray);
		$this->load->template('role/edit',$data);
    	$this->load->view('role/_js');
	}
	public function role_edit_response(){
		$id= $this->input->post('id');
		$editData['name'] = $this->input->post('name');
		$editData['depart_id'] = $this->input->post('depart_id');
		$update = $this->Home_models->update_role($editData, $id);
		$return_arr = array();
		if($update>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data Success Fully Updated");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
	}

	/************** User ******************/
	public function user(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('user/index',$data);
		$this->load->view('user/_js');
	}
	public function user_response(){
		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		$this->db->select("ps_user_profile.fk_parent_id as id,
						   ps_user_profile.employee_id,
						   ps_user_profile.extension,
						   ps_user_profile.first_name as first_name,
						   ps_user_profile.last_name last_name,
						   ps_user_profile.first_name_real as first_name_real,
						   ps_user_profile.last_name_real as last_name_real,
						   ps_user_profile.role,
						   ps_team.name as user_team, 
						   ps_role.name as user_role, 
						   ps_department.name as user_department
			");
		$this->db->from("ps_user_profile");
		$this->db->join('ps_team', 'ps_user_profile.team = ps_team.id','left');
		$this->db->join('ps_role', 'ps_user_profile.role = ps_role.id','left');
		$this->db->join('ps_department', 'ps_user_profile.department = ps_department.id','left');
		$this->db->order_by("ps_user_profile.id","desc"); 
		$query = $this->db->get();
		$data = [];

      $count=0;     
      foreach($query->result() as $r) {
		  	$btn = '<div class="btn-group" data-toggle="buttons">'; 
      		$btn .= '<a href="'.base_url().'user/edit/'.$r->id.'" class="btn btn-warning btn-icon">';
      		$btn .= '<i class="fa fa-eye"></i>';
      		$btn .= '</a>';
      		$btn .= '<a href="'.base_url().'user/website/'.$r->id.'" class="btn btn-primary btn-icon">';
      		$btn .= '<i class="fa fa-globe"></i>';
      		$btn .= '</a>';
			if($r->role == '1' || $r->role == '2'){
				$btn  .= '<a href="'.base_url().'user/team/'.$r->id.'" class="btn btn-danger btn-icon">';
				$btn .= '<i class="fa fa-plus"></i>';
				$btn .= '</a>';
			}
			$btn .= '<div>';
			$username_s =  $r->first_name."-".$r->last_name;
			$username_r =  $r->first_name_real."-".$r->last_name_real;
			$data[] = array(
                ++$count,
                $username_r,
                $username_s,
                $r->user_role,
                $r->user_team,
                $r->user_department,
                $r->employee_id,
                $r->extension,
                $btn
           );
      }


      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );


      echo json_encode($result);
	}
	public function user_add(){
		$data['role'] = $this->Home_models->selectrecords('ps_role');
		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('user/add',$data);
    	$this->load->view('user/_js');
	}
	public function user_add_response(){
		$username = $_POST['user_name'];
		$array = array('user_name'=>$username);
		$data['validateUser'] = $this->Home_models->selectrecords('ps_user_login',$array);
		if(!empty($data['validateUser'])){
			$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"User Already Exist");
		}
		else{
			$allow_ip = !isset($_POST['allow_ip']) ? '0' : '1';
			$team_lead = !isset($_POST['team_leads']) ? '0' : $_POST['team_leads'];
			$manager = !isset($_POST['manager']) ? '0' : $_POST['manager'];
			$userArray1 = array('user_name'=>$_POST['user_name'],'password'=>md5($_POST['password']),'ip_allow'=>"$allow_ip");
			$adduser1 = $this->Home_models->saverecords('ps_user_login',$userArray1);
			if($adduser1 > 0){
				// if($_POST['role'] == 3){
				// 	$executive = $adduser1;
				// }else{
				// 	$executive = '0';
				// }
				$userArray2 = array(
					'first_name'	 =>$_POST['first_name'],
					'last_name'		 =>$_POST['last_name'],
					'first_name_real'=>$_POST['first_name_real'],
					'last_name_real' =>$_POST['last_name_real'],
					'role'			 =>$_POST['role'],
					'team'			 =>$_POST['team'],
					'department'	 =>$_POST['department'],
					'employee_id'	 =>$_POST['employee_id'],
					'extension'		 =>$_POST['extension'],
					'fk_parent_id'	 =>$adduser1,
					'added_by'		 => '2',
					'manager'		 => $manager,
					'team_lead'		 => $team_lead,
					'executive'		 => $executive,
					'refund'		 => '0',
				);
				$adduser2 = $this->Home_models->saverecords('ps_user_profile',$userArray2);
				// echo $this->db->last_query();
				if($adduser2 > 0){
					$return_arr[] = array("Type" => "Success","Error_type" => "department","msg"=>"Data Success Fully Inserted");
				}else{
					$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"Server Error");
				}
			}
		}

		
		echo json_encode($return_arr);
    }
	public function user_edit($id = null){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$data['dep']  = $this->Home_models->selectrecords('ps_department');
		$data['role'] = $this->Home_models->selectrecords('ps_role');
		$this->db->select("*");
		$this->db->from("ps_user_login");
		$this->db->join('ps_user_profile', 'ps_user_login.id = ps_user_profile.fk_parent_id');
		$this->db->where('ps_user_login.id', $id);
		$this->db->order_by("ps_user_login.id","desc"); 
		$query = $this->db->get();
		$data['userdetails'] = $query->result();
		$this->load->template('user/edit',$data);
		$this->load->view('user/_js');
	}
	public function user_edit_response(){
		$user_name 		 	= $_POST['user_name'];
		$password 		 	= $_POST['password'];
		$first_name 	 	= $_POST['first_name'];
		$last_name 		 	= $_POST['last_name'];
		$first_name_real 	= $_POST['first_name_real'];
		$last_name_real  	= $_POST['last_name_real'];
		$employee_id 		= $_POST['employee_id'];
		$extension 			= $_POST['extension'];
		$team 				= $_POST['team'];
		$department 		= $_POST['department'];
		$role 				= $_POST['role'];
		$user_id 			= $_POST['user_id'];

		if($password == ''){
			$allow_ip = !isset($_POST['allow_ip']) ? '0' : '1';
			// echo $allow_ip;
			// die();
			$data = array(
				'user_name' => $user_name,
				'ip_allow'=>"$allow_ip"
			);
			$data1 = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'first_name_real' => $first_name_real,
				'last_name_real' => $last_name_real,
				'employee_id' => $employee_id,
				'extension' => $extension,
				'team' => $team,
				'department' => $department,
				'role' => $role
			);
		}else{
			$allow_ip = !isset($_POST['allow_ip']) ? '0' : '1';
			// echo $allow_ip;
			// die();
			$data = array(
				'user_name' => $user_name,
				'password' => md5($password),
				'ip_allow'=>"$allow_ip"
			);
			$data1 = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'first_name_real' => $first_name_real,
				'last_name_real' => $last_name_real,
				'employee_id' => $employee_id,
				'extension' => $extension,
				'team' => $team,
				'department' => $department,
				'role' => $role
			);
		}

		$this->db->where('id', $user_id);
		$this->db->update('ps_user_login', $data);

		$this->db->where('fk_parent_id', $user_id);
		$this->db->update('ps_user_profile', $data1);
		
		$return_arr[] = array("Type" => "Success","Error_type" => "User","msg"=>"Data Success Fully Updated");

		echo json_encode($return_arr);
	}
	public function user_team($id = null){
		$data['team_lead_id'] = $id;
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('user/team',$data);
		$this->load->view('user/_js');
	}
	public function user_team_response(){     
		$action = $_POST['action'];
		if($action == 'update_team_lead'){
			$update_array = array('team_lead'=>$_POST['team_lead_id']);
		}else if($action == 'update_manager'){
			$update_array = array('manager'=>$_POST['team_lead_id']);
		}
		
		foreach($_POST['users'] as $user_id){
			$create_user_ids = $user_id;
			$this->db->where('fk_parent_id', $create_user_ids);
			$this->db->update('ps_user_profile', $update_array);
		}
		$return_arr[] = array("Type" => "Success","Error_type" => "User","msg"=>"User Assigned");
		echo json_encode($return_arr);
	}
	public function user_website($id = null){
		$data['menu'] = $this->MenuModel->category_menu(1);
		//$userArray = array('id' => $id);
		$data['id'] = $id;
		$data['website'] = $this->Home_models->selectrecords('ps_website');
		$this->load->template('user/website',$data);
    	$this->load->view('user/_js');
	}
	public function user_website_assign_response(){
		$id = $this->input->post('id');
		$web_id= $this->input->post('name');
		$exe_count = 1;
		foreach($web_id as $webid) {
			$Array = array(
				'user_id'=>$id,
				'website_id'=>$webid,
				'display_id'=>"1"
			);
			$this->db->select("*");
			$this->db->from("ps_website_access");

			$this->db->where('user_id', $id);
			$this->db->where('website_id', $webid);
			$this->db->where('display_id', '0');
			$query = $this->db->get();
			$check = $query->num_rows();
			// echo $check;
			// die();
			if($check == '1')
			{
				$Array1 = array(
						'display_id'=>"1"
				);
				$this->db->where('user_id', $id);
				$this->db->where('website_id', $webid);
				$update_web=$this->db->update('ps_website_access',$Array1);
			}
			else{
				$addwebsite = $this->Home_models->saverecords('ps_website_access',$Array);			
			}

		}
		$return_arr = array();
		$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data Success Fully Updated");
		echo json_encode($return_arr);
	}
	public function user_website_unassign_response(){
		$user_id = $this->input->post('id');
		$web_id= $this->input->post('name');
		$exe_count = 1;
		foreach($web_id as $webid) {
			$Array = array(
					'display_id'=>"0"
				);
			$Array1 = array(
					'website_id'=>$webid,
				);
			$this->db->where('user_id', $user_id);
			$this->db->where('website_id', $webid);
			$addwebsite=$this->db->update('ps_website_access',$Array);
		}
		$return_arr = array();
		if($addwebsite>0){
		 	$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data Success Fully Updated");
		}else{
		 	$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
	}


	/************** Leads ******************/
	public function leads(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('leads/index',$data);
		$this->load->view('leads/_js');
	}
	public function leads_response(){

		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		$this->db->select("
		pl.id as lead_id,
		pl.lead_code,
		pl.created_at,
		pl.created_by,
		pl.comments,
		pl.website_id,
		pl.team_id,
		pl.type_lead,
		pc.name,
		pc.email,
		pc.number,
		pt.name as lead_team,
		pup.first_name as first_name_user,
		pup.last_name as last_name_user,
		pls.name as status,
		pls.status_btn as status_btn,
		");
		$this->db->from("ps_leads as pl");
		$this->db->join('ps_customers as pc', 'pl.id = pc.lead_id');
		$this->db->join('ps_team as pt', 'pl.team_id = pt.id');
		$this->db->join('ps_user_profile as pup', 'pup.fk_parent_id = pl.created_by','left');
		$this->db->join('ps_leads_status as pls', 'pls.id = pl.lead_status');
		$this->db->order_by("pl.id","desc"); 
		$query = $this->db->get();
		$data = [];

      $count=0;     
      foreach($query->result() as $r) {

		$btn = '<div class="btn-group" data-toggle="buttons">';
		$btn .= '<button id="'.$r->lead_id.'" onclick="edit_leads(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
		$btn .= '<button id="'.$r->lead_id.'" onclick="view(this.id)" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button>';
		$btn .= '<button id="'.$r->lead_id.'" onclick="deleted(this.id)" class="btn btn-danger btn-sm"><i class="fas fa-history"></i></button>';
		$btn .='</div>';
		
		$btn_lead = '<button onclick="copyToClipboard(this.id)" id="'.$r->lead_code.'" class="btn btn-primary btn-sm">'.$r->lead_code.'</button>';
		$btn_number = '<button onclick="copyToClipboard(this.id)" id="'.$r->number.'" class="btn btn-primary btn-sm">'.$r->number.'</button>';
		$btn_user_name = '<span class="badge es-label " style="font-size : 13px">'.$r->first_name_user.'-'.$r->last_name_user.'</span>';
		$btn_status = '<span class="badge '.$r->status_btn.' es-label">'.$r->status.'</span>';
			$data[] = array(
				++$count,
                $btn_lead,
                $r->name,
                $r->email,
                $btn_number,
                $r->created_at,
				$btn_user_name,
                // $r->comments,
                $btn_status,
                $r->website_id."website here",
                $r->lead_team,
                $r->type_lead,
                $btn
           );
      }
      $result = array(
               "draw" => $draw,
				"recordsTotal" => $query->num_rows(),
				"recordsFiltered" => $query->num_rows(),
				"data" => $data
            );
      echo json_encode($result);
	}
	public function leads_add(){
		$team = $_SESSION['user_profile'][0]['team'];
		$data['menu'] = $this->MenuModel->category_menu(1);
		$filter['team'] = $team;
		$data['websites'] = $this->Home_models->selectrecords('ps_website',$filter);
		$this->load->template('leads/add',$data);
    	$this->load->view('leads/_js');
	}
	public function leads_add_response(){
		
		$this->db->select("*");
		$this->db->from("ps_leads");
		$this->db->order_by("id","desc"); 
		$query = $this->db->get()->result();
		$last_lead_code = $query[0]->lead_code;
		$filter_lead_code = substr($last_lead_code,3);
		$add_number = $filter_lead_code+1;

		//Lead Table
		$new_lead_code = "LD-".$add_number;
		$time = date('y-m-d h:i:s');
		$created_by = $_SESSION['user_profile'][0]['id'];
		$comments = htmlspecialchars($_POST["comments"],ENT_QUOTES);
		$expected_amount = $_POST['expected_amount'];
		$lead_status = '1';
		$website = $_POST['website'];
		$team = $_SESSION['user_profile'][0]['team'];
		$user_name = $_SESSION['user_profile'][0]['first_name']."-".$_SESSION['user_profile'][0]['last_name'];

		//Lead Customer
		$customer_name = $_POST['customer_name'];
		$customer_email = $_POST['customer_email'];
		$customer_phone = $_POST['customer_phone'];
		

		
			$lead_main_table = array(
				'lead_code'=>$new_lead_code,
				'created_at'=>$time,
				'created_by'=>$created_by,
				'comments'=>$comments,
				'expected_amount'=>$expected_amount,
				'lead_status'=>$lead_status,
				'website_id'=>$website,
				'team_id'=>$team,
			);

			$lead_main = $this->Home_models->saverecords('ps_leads',$lead_main_table);
			if($lead_main > 0){
				$customer_table = array(
					'lead_id'=>$lead_main,
					'name'=>$customer_name,
					'email'=>$customer_email,
					'number'=>$customer_phone,
					'password'=>md5('asad'),
				);
				$customer_ = $this->Home_models->saverecords('ps_customers',$customer_table);
				if($customer_ > 0){
					$lead_history_table = array(
						'lead_id' =>$lead_main,
						'user_id' =>$created_by,
						'comments'=>$comments,
						'message' =>$user_name." Added Lead ". $lead_main,
						'status'=>'1',
					);
					$lead_history_add = $this->Home_models->saverecords('ps_leads_history',$lead_history_table);
					if($lead_history_add > 0){
						$return_arr[] = array("Type" => "Success","Error_type" => "lead","msg"=>"Lead Successfully Created");
					}else{
						$return_arr[] = array("Type" => "Error","Error_type" => "lead","msg"=>"Lead History Error");
					}
				}else{
					$return_arr[] = array("Type" => "Error","Error_type" => "lead","msg"=>"Customer Details Error");
				}
			}else{
				$return_arr[] = array("Type" => "Error","Error_type" => "lead","msg"=>"Lead Creation Error");
			}
			echo json_encode($return_arr);
    }
	public function leads_action(){
		// print_r($_POST);
		// die();
		$data['id'] = $_POST['id'];
		$data['action'] = $_POST['action'];
		
		$data['status'] = $this->Home_models->selectrecords('ps_leads_status');
		
		$this->load->view('leads/tabs',$data);
	}
	public function leads_action_response(){
		$action = $_POST['action'];
		$lead_id = $_POST['id'];
		$created_by = $_SESSION['user_profile'][0]['id'];
		$user_name = $_SESSION['user_profile'][0]['first_name']."-".$_SESSION['user_profile'][0]['last_name'];
		if($action == 'comments_add'){
			$status = $_POST['status'];
			$comments = htmlspecialchars($_POST["comments"],ENT_QUOTES);
			$commments_form_array = array(
				'lead_id' => $lead_id,
				'user_id'=>$_SESSION['user_profile'][0]['id'],
				'comments' => $comments,
				'status' => $status
			);
			$lead_data = array(
				'lead_status' => $status,
				'created_by' => $_SESSION['user_profile'][0]['id']
			);
			
			
			$add_comments = $this->Home_models->saverecords('ps_leads_history',$commments_form_array);
			if($add_comments>0){
				$this->db->where('id', $lead_id);
				$this->db->update('ps_leads', $lead_data);

				echo "1";
			}else{
				echo "0";
			}

		}else if($action == 'reviewstatus'){
			print_r($_POST);
		
		}else if($action == 'ownership'){
			$status = '1';
			$comments = htmlspecialchars($_POST["comments"],ENT_QUOTES);
			$commments_form_array = array(
				'lead_id'   =>$lead_id,
				'user_id'   =>$created_by,
				'comments'  =>$comments,
				'message'   =>$user_name." Owned Lead Id is". $lead_id,
				'file_path' =>'',
				'status'=>'1',
			);
			$add_comments = $this->Home_models->saverecords('ps_leads_history',$commments_form_array);
			if($add_comments>0){
				echo "1";
			}else{
				echo "0";
			}
		}else if($action == 'ownchange'){
			print_r($_POST);
		}else if($action == 'reminder'){
			print_r($_POST);
		}else if($action == 'addchat'){
			$comments = htmlspecialchars($_POST["comments"],ENT_QUOTES);
			$lead_id_array = array('id'=>$lead_id);
			$row_lead = $this->Home_models->selectrecords('ps_leads',$lead_id_array); 
			$lead_code_filter = array('lead_id' => $lead_id, 'file_path!=' => '');
			$this->db->select('count(*) as count');
			$this->db->from("ps_leads_history");
			$this->db->where($lead_code_filter);
			$query = $this->db->get()->result();
			$file_name = $query[0]->count;
			$new_code = $row_lead[0]['lead_code'].'-'.$file_name;
			$receipt_path = '';
			if(!empty($_FILES)){
				$config['upload_path'] = 'uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['file_name'] = $new_code;
				$this->load->library('upload', $config);
				$count = count($_FILES);
				if($count == 1){
					foreach ($_FILES as $f => $name){
						if($this->upload->do_upload($f)){
							$receipt_path = $config['upload_path']."".$config['file_name']."".$this->upload->data()['file_ext'];
							// print_r($this->upload->data());
							// echo "Your File Uploaded".$receipt_path;
						}else{
							print_r($this->upload->display_errors());
						}
					}
				}
				if($count > 1){
					$zip = new ZipArchive(); 
					$f1 = mt_rand(0,1);
					$f2 = mt_rand(0,1);
					// $receipt_path = "../uploads/$f1/".$new_code.".zip";
					$receipt_path = "uploads/".$new_code.".zip";
					if($zip->open($receipt_path, ZipArchive::CREATE) !== TRUE) {
						$error .= "* Sorry ZIP creation failed at this time<br/>";
					}
					foreach($_FILES as $k => $value) {
						
						if($value == '') { // not empty field
							continue;
						}
						$zip->addFromString($value['name'], file_get_contents($value['tmp_name']));
					}
					$zip->close();
				}
					$lead_history_table = array(
						'lead_id'   =>$lead_id,
						'user_id'   =>$created_by,
						'comments'  =>$comments,
						'message'   =>$user_name." Added Lead ". $lead_id,
						'file_path' =>$receipt_path,
						'status'=>'1',
					);
					$lead_history_add = $this->Home_models->saverecords('ps_leads_history',$lead_history_table);
					if($lead_history_add > 0){
						echo '1';
					}else{
						echo '0';
					}
				}
				else{
					
				}	
				

		}else{
			echo 'No Action Found';
		}
	}



	/************** Websites ******************/
	public function website(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('website/index',$data);
		$this->load->view('website/_js');
	}
	public function website_response(){
		
		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		$this->db->select("
		pw.id as website_id,
		pw.name as website_name,
		pw.descriptor,
		pw.logo,
		pw.team as pw_team_id  ,
		pw.type, 
		pw.status as status,
		pw.created_at,
		pw.created_by,
		pt.id as team_id,
		pt.name as t_name,
		pup.fk_parent_id,
		pup.first_name,
		pup.last_name
		
		");
		$this->db->from("ps_website as pw");
		$this->db->join('ps_team as pt', 'pw.team = pt.id','left');
		$this->db->join('ps_user_profile as pup', 'pup.fk_parent_id = pw.created_by','left');
		$this->db->order_by("pw.id","desc"); 
		$query = $this->db->get();
		$data = [];
      $count=0;     
      foreach($query->result() as $r) {
		$btn = '<div class="btn-group" data-toggle="buttons">';
		$btn .= '<button id="'.$r->website_id.'" onclick="edit_website(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
		$btn .='</div>';

		$badge = $r->status == 1 ? 'badge-success' : 'badge-danger';
        
        $w_status = $r->status == 1 ? 'Active' : 'Inactive';

        $web_status= "<span class='badge $badge p-2 font-weight-bold text-uppercase' style='font-size: 10px; letter-spacing: 3px;'> $w_status </span>";
        $path = $r->logo;
        $base= base_url()."uploads/logo/";
        $logo_path = "<img src='$base$path' width='40'>";

		$created_by = '<span class="badge es-label " style="font-size : 13px">'.$r->first_name." ".$r->last_name.'</span>';
			$data[] = array(
				++$count,
                $r->website_name,
                $r->descriptor, 
                $r->t_name,
                $r->type,
                $r->created_at,
				$created_by,
				$web_status,  
                $logo_path,
                $btn 
           );
      }
      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );
      echo json_encode($result);
	}
	public function website_add(){
		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('website/add',$data);
    	$this->load->view('website/_js');
	}
	public function website_add_response(){
		if(isset($_FILES["logo"]["name"]))  
		{
			$config['upload_path'] = './uploads/logo';  
			$config['allowed_types'] = 'jpg|jpeg|png|gif';  
			$this->load->library('upload', $config);  

			if(!$this->upload->do_upload('logo'))  
			{  
				echo $this->upload->display_errors();  
			}  
			else  
			{  
				$data = array('upload_data' => $this->upload->data());
				$array['name'] = $_POST['name'];
				$array['descriptor'] = $_POST['descriptor'];
				$array['type'] = $_POST['type'];
				$array['team'] = $_POST['team'];
				$array['logo']= $data['upload_data']['file_name']; 
				$array['Status']= "1"; 
				$array['rigion']= "0"; 
				$array['created_by']=$_SESSION['user_profile'][0]['id'];
				$addwebsite = $this->Home_models->saverecords('ps_website',$array);
				$return_arr = array();
				if($addwebsite>0)
				{
					$return_arr[] = array("Type" => "Success","Error_type" => "Website","msg"=>"Data Success Fully Inserted");
				}
				else
				{
					$return_arr[] = array("Type" => "Error","Error_type" => "Website","msg"=>"Server Error");
				}
				echo json_encode($return_arr);
			}
		} 
    }  
	public function website_action(){
		$data['id'] = $_POST['id'];
		$data['team'] = $this->Home_models->selectrecords('ps_team');	
		$this->load->view('website/tabs',$data);
	}
	public function website_action_response(){
		$action = $_POST['action'];
		if($action == 'change_team'){
		$id= $this->input->post('id');
	   $editData['team'] = $this->input->post('team');
       $this->db->where('id', $id);
       $update= $this->db->update('ps_website', $editData);
       	$return_arr = array();
		if($update>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data Success Fully Updated");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
		}else if($action == 'change_type'){
			$id= $this->input->post('id');
		$editData['type'] = $this->input->post('type');
        $this->db->where('id', $id);
        $update= $this->db->update('ps_website',$editData);
		$return_arr = array();
		if($update>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data SuccessFully Updated");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
		}else if($action == 'change_status'){
				$id= $this->input->post('id');
		$editData['status'] = $this->input->post('status');
        $this->db->where('id', $id);
       $update= $this->db->update('ps_website', $editData);
       
		$return_arr = array();
		if($update>0){
			$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data SuccessFully Updated");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
			
		}
		else{
			echo 'anotherone';
		}
	}



	/************** Invoice ******************/
	public function invoice(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('invoice/index',$data);
		$this->load->view('invoice/_js');
	}
	public function invoice_response(){
		
		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		$this->db->select("
		inv.id as invoice_id,
		inv.invoice_no,
		inv.lead_id,
		inv.amount,
		inv.currency,
		inv.status,
		inv.added_by ,
		inv.created_at,
		inv.team as team_id,
		inv.website,
		ld.id as lead_id,
		ld.lead_code,
		pt.id as team_id,
		pt.name as team_name,
		pup.id as user_id,
		pup.first_name,
		pup.last_name
		");
		$this->db->from("ps_invoice_basic as inv");
		$this->db->join('ps_leads as ld', 'ld.id= inv.lead_id');
		$this->db->join('ps_team as pt', 'pt.id = inv.team');
		$this->db->join('ps_user_profile as pup', 'pup.id  = inv.added_by');
		$this->db->order_by("inv.id","desc"); 
		$query = $this->db->get();
		$data = [];
		$count=0;     
		foreach($query->result() as $r) {
			$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->invoice_id.'" onclick="edit_website(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn .='</div>';
			
			$badge = $r->status == 1 ? 'badge-success' : 'badge-danger';
			
			$inv_status = $r->status == 1 ? 'Paid' : 'Unpaid';
			
			$in_status= "<span class='badge $badge p-2 font-weight-bold text-uppercase' style='font-size: 10px; letter-spacing: 3px;'> $inv_status </span>";
		
			$data[] = array(
				++$count,
				$r->invoice_no,
				$r->lead_code,
				$r->created_at,
				$r->amount."-".$r->currency,
				$r->first_name,
				$in_status,
				$r->website,
				$btn 
			);
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}
	public function invoice_add(){
		$team = $_SESSION['user_profile'][0]['team'];
		$filter['team'] = $team;
		$data['first_name']=$_SESSION['user_profile'][0]['first_name'];
		$data['last_name']=$_SESSION['user_profile'][0]['last_name'];
		$data['service'] = $this->Home_models->selectrecords('ps_services');
		$data['website'] = $this->Home_models->selectrecords('ps_website',$filter);
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('invoice/add',$data);
		$this->load->view('invoice/_js');
	}
	public function invoice_add_response(){
		$array = $_POST;
			$this->db->select("*");
			$this->db->from("ps_invoice_basic");
			$this->db->order_by("id","desc"); 
			$query = $this->db->get()->result();
	    	$last_invoice_no = $query[0]->invoice_no;
			$filter_invoice_no = substr($last_invoice_no,4);
			$add_number = $filter_invoice_no+1;
			$new_invoice_no = "INV-".$add_number;
			$added_by=$_SESSION['user_profile'][0]['id'];	 
			$invArray = array(
				'invoice_no'=>$new_invoice_no,
				'lead_id'=>$_POST['lead_id'],
				'amount'=>$_POST['amount'],
				'currency'=>$_POST['currency'],
				'display_id'=>"1",
				'added_by'=>$added_by,
				'team'=>$_SESSION['user_profile'][0]['team'],
				'website'=>$_POST['website'],
				'status'=>"1",	
					);
			$addivoice = $this->Home_models->saverecords('ps_invoice_basic',$invArray);
		if($addivoice >0){
			$data = json_decode($_POST['invoice_detail']);    
		    foreach ($data as $obj){
				   $service_id= $obj->service;
				   $comment= $obj->comments;
				   $Array = array(
						 'invoice_id'=>$addivoice,
						 'service_id'=>$service_id,
						 'comments'=>$comment	
					 );
				      $add_invoice_detail = $this->Home_models->saverecords('ps_invoice_detail',$Array);
				}
			   }
			$return_arr = array();
		if($add_invoice_detail>0){
				$return_arr[] = array("Type" => "Success","Error_type" => "Invoice","msg"=>"Data Success Fully Inserted");
			}else{
				$return_arr[] = array("Type" => "Error","Error_type" => "Invoice","msg"=>"Server Error");
			}
			echo json_encode($return_arr);
	}
	public function get_invoive_custumer_detail(){
		$lead_code = $_POST["ID"];
		$array = array('lead_code'=> $lead_code);
        $get_lead_details = $this->Home_models->selectrecords('ps_leads',$array);
        $get_lead_id =$get_lead_details[0]['id'];
        if($lead_code == "")
        {
        	echo "please fill";
        }
        else{
        $array1 = array('lead_id'=> $get_lead_id);
        $get_customer_details = $this->Home_models->selectrecords('ps_customers',$array1); 
        $data['lead_id'] = $get_customer_details[0]['lead_id'];
        $data['customer_name'] = $get_customer_details[0]['name'];
        $data['customer_email'] = $get_customer_details[0]['email'];
        $data['customer_no'] = $get_customer_details[0]['number'];
		echo '<table id="custumer_dtl" class="table table-striped table-hover table-sm table-bordered">
				<thead>
					<tr class="text-center">
						<th colspan=4>
							<label class="badge badge-warning p-2 w-100 text-uppercase">
								<h6>Lead Detail</h6>
							</label>
						</th>
					</tr>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Number</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<input type="hidden" name="id"  id="cus-id" value='.$data['lead_id'].'>
						<td>
							<input type="radio" name="name"  id="cus-name" value='.$data['customer_name'].'>   
							<label for="cus-name">'.$data['customer_name'].'</label>
						</td>
						<td>
							<input type="radio" name="email"  id="cus-email" value='.$data['customer_email'].'>   
							<label for="cus-name">'.$data['customer_email'].'</label>
						</td>
						<td>
							<input type="radio" name="number"  id="cus-number" value='.$data['customer_no'].'>
							<label for="cus-name">'.$data['customer_no'].'</label>
						</td>
					</tr>
				</tbody>
			</table>';
		}
    }


	/************** Orders ******************/
	public function order(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('order/index',$data);
		$this->load->view('order/_js');
	}
	public function order_response(){
		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		
		$this->db->select("
		orc.* , 
		ord.invoice_id as invoice_id
		");
		
		$this->db->from("ps_order_main as ord");
		$this->db->join('ps_order_child as orc', 'orc.order_id = ord.id');
		
		// $this->db->where('orc.display', '1');
		$query = $this->db->get();
		
	
		$data = [];
		$count=0;     
		foreach($query->result() as $r) {
			$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->id.'" onclick="edit_order(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn .='</div>';
			
			$get_service = $this->getDetilsById('id',$r->services,'ps_services');
			$service = $get_service[0]['name'];

			$get_user = $this->getDetilsById('fk_parent_id',$r->assign_to,'ps_user_profile');
			$assign_user = $get_user[0]['first_name']." - ".$get_user[0]['last_name'];

			$get_inv = $this->getDetilsById('id',$r->invoice_id,'ps_invoice_basic');
			$invoice_no = $get_inv[0]['invoice_no'];
			
			$oi = $r->order_code.' / '.$invoice_no;
			$data[] = array(
				++$count,
				$oi,
				$r->view_code,
				"dev role",
				$r->sale_date,
				$r->delivery_date,
				$service,
				$r->production_status,
				$r->support_status,
				$assign_user,
				$btn,
			);
		}
		$result = array(
			"draw" => $draw,
			"recordsTotal" => $query->num_rows(),
			"recordsFiltered" => $query->num_rows(),
			"data" => $data
		);
		echo json_encode($result);
	}
	public function order_action(){
		$data['id'] = $_POST['id'];
		$data['action'] = $_POST['action'];
		// $data['status'] = $this->Home_models->selectrecords('ps_leads_status');
		$this->load->view('order/tab',$data);
	}
	public function order_action_response(){
		
	}
	public function order_add(){
		$this->load->view('order/add');
	}


	/************** Customer ******************/
	public function customer(){
		$data['menu'] = $this->MenuModel->category_menu(1);

		//$data['team'] = $this->Home_models->selectrecords('ps_team');
		$this->load->template('customer/index',$data);
		$this->load->view('customer/_js');
	}
	public function customer_response(){
		$draw = intval($this->input->get("draw"));
		$start = intval($this->input->get("start"));
		$length = intval($this->input->get("length"));
		$this->db->select("*");
		$this->db->from("ps_customers");
		$this->db->order_by("id","desc"); 
		$query = $this->db->get();
		
		$data = [];

		$count=0;     
		foreach($query->result() as $r) {
			$data[] = array(
					++$count,
					$r->name,
					$r->email,
					$r->password             
			);
		}
		$result = array(
				"draw" => $draw,
				"recordsTotal" => $query->num_rows(),
				"recordsFiltered" => $query->num_rows(),
				"data" => $data
			);
		echo json_encode($result);
	}

}