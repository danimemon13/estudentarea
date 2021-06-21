<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        
    }
    public function ci_global_variable_tutorial(){
    	$this->load->view('show_global_variables');
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
			//$this->login();
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
    }

	
	

	/************** Department ******************/
	public function department(){
		$data['department'] = $this->Home_models->selectrecords('ps_department');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('department/index',$data);
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



	/************** Team ******************/
	public function team(){
		$data['menu'] = $this->MenuModel->category_menu(1);

		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$this->load->template('team/index',$data);
		$this->load->view('team/_js');
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



	/************** Role ******************/
	public function role(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('role/index',$data);
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


	/************** User ******************/
	public function user(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('user/index',$data);
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
			$userArray1 = array('user_name'=>$_POST['user_name'],'password'=>md5($_POST['password']),'ip_allow'=>"1");
			$adduser1 = $this->Home_models->saverecords('ps_user_login',$userArray1);
	
			if($adduser1 > 0){
				$userArray2 = array(
					'first_name'=>$_POST['first_name'],
					'last_name'=>$_POST['last_name'],
					'first_name_real'=>$_POST['first_name_real'],
					'last_name_real'=>$_POST['last_name_real'],
					'role'=>$_POST['role'],
					'team'=>$_POST['team'],
					'department'=>$_POST['department'],
					'employee_id'=>$_POST['employee_id'],
					'extension'=>$_POST['extension'],
					'fk_parent_id'=>$adduser1,
					'added_by'=> '2',
					'manager'=> '0',
					'team_lead'=> '0',
					'executive'=> '0',
					'refund'=> '0',
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

}