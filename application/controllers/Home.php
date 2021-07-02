<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');    
		$this->load->library('zip');    
		$this->load->helper('pdf_helper');  
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
		$return_arr = array();
		if(!empty($data['login'])){
			if($data['login'][0]['status'] == 0){
				$return_arr[] = array("Type" => "Error","Error_type" => "login","msg"=>"Your Account Has Been Blocked By CRM Team");
			}else{
				//check ip ::1	
				if($data['login'][0]['ip_allow'] == 0){
					if(!$this->check_ip()){
						$return_arr[] = array("Type" => "Error","Error_type" => "login","msg"=>"You Don't Have OutSide Access");
					}
					else{
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
				}
				else{
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
			}
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
		$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
		$message = $username." is Logged Out";
		$this->create_logs('Login Area',$message);
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
	public function send_mail($from_email,$your_name,$to_email,$subject,$body){
        $this->load->library('email');
        $this->email->from($from_email, $your_name);
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($body);

        //Send mail 
        if ($this->email->send()){
            // $this->session->set_flashdata("email_sent", "Email sent successfully.");
		}
        else{
            // $this->session->set_flashdata("email_sent", "Error in sending Email.");
		}
        // $this->load->view('email_form');
    }
	public function delete_response() {
		$id = $_POST['id'];
		$table = $_POST['table'];
		$columnName = $_POST['columnName'];
		$columnvalue = $_POST['columnvalue'];
		$display_data = array($columnName => $columnvalue);
		$update = $this->Home_models->delete_globle($table,$id,$display_data);
		$return_arr = array();
		if ($update > 0) {
			/*********************Logs*************************/
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Deleted Column ".$columnName." On Id ".$id;
			$this->create_logs("Deleted ".$table.' Area',$message);
			 /*********************Logs End*************************/
			$return_arr[] = array("Type" => "Success", "Error_type" => "Team", "msg" => "Data Success Fully Updated");
		} else {
			$return_arr[] = array("Type" => "Error", "Error_type" => "Team", "msg" => "Server Error");
		}
		echo json_encode($return_arr);
	}
	public function check_ip(){
		$filter_ip['ip'] = $this->input->ip_address();
		$get_rows = $this->Home_models->selectrecords('ps_ip_allowed',$filter_ip);
		return count($get_rows) > 0 ? true : false;
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
	      $this->db->where('ps_department.status !=' ,"0");
		  $this->db->join('ps_department', 'ps_team.id = ps_department.fk_team_id');
	      $this->db->order_by("ps_department.id","desc"); 
	      $query = $this->db->get();
      $data = [];
      $count=0;     
      foreach($query->result() as $r) {
			$btn  = '<div class="btn-group" data-toggle="buttons">';
      		$btn .= '<a href="'.base_url().'department/edit/'.$r->id.'" class="btn btn-primary btn-icon">';
      		$btn .= '<i class="fa fa-pencil-alt"></i>';
      		$btn .= '</a>';
      		$btn .= '<button onClick="deleted(this.id)" id="'.$r->id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
      		$btn .= '</button>';
			$btn .= '</div">';
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
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Added New Department";
			$this->create_logs('Department Area',$message);			
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
		$editData['name'] = $this->input-> post('name');
        $editData['fk_team_id'] = $this->input->post('fk_team_id');
        /*********************Logs*************************/
		$this->db->select("*");
		$this->db->from("ps_department");
		$this->db->where('ps_department.id', $id);
		$prev = $this->db->get()->result();
		$prev_data = (array) $prev[0];
		/*********************Logs*************************/
		$update = $this->Home_models->update_globl('ps_department',$id,$editData);
		$return_arr = array();
		if($update>0){
		$id= $this->input->post('id');
		$this->db->select("*");
		$this->db->from("ps_department");
		$this->db->where('ps_department.id', $id);
		$updated= $this->db->get()->result();
		$updated_data = (array) $updated[0];
	    $newValues=array_diff_assoc($updated_data,$prev_data);
		$oldValues=array_diff_assoc($prev_data,$updated_data);
		 foreach ($newValues as $key => $value) {
					$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
                    $message = $username." Updated ".$key." From ".$oldValues[$key]." To ".$value;
                    $this->create_logs('Department Area',$message);
                }
         /*********************Logs End*************************/
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
      $this->db->where('ps_team.status !=' ,"0");
      $this->db->order_by("id","desc"); 
      $query = $this->db->get();
      $data = [];
      $count=0;     
      foreach($query->result() as $r) {
		  	$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<a href="'.base_url().'team/edit/'.$r->id.'" class="btn btn-primary btn-icon">';
			$btn .= '<i class="fa fa-pencil-alt"></i>';
			$btn .= '</a>';
			$btn  .= '<button onClick="deleted(this.id)" id="'.$r->id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
			$btn .= '</button>';
			$btn .= '</div>';
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
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Added New Team";
			$this->create_logs('Team Area',$message);
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
		$this->db->select("*");
		$this->db->from("ps_team");
		$this->db->where('ps_team.id', $id);
		$query = $this->db->get()->result();
		$last_team_name=$query[0]->name;
		$editData['name'] = $this->input-> post('name');
		$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
		$message = $username." is Updated From " .$last_team_name." to ".$editData['name'];
		$this->create_logs('Team Area',$message);

		$update = $this->Home_models->update_globl('ps_team',$id,$editData);
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
      $this->db->where('ps_role.status !=' ,"0");
	  $this->db->join('ps_department', 'ps_role.depart_id = ps_department.id');
      $this->db->order_by("ps_role.id","desc");
      $query = $this->db->get();
      $data = [];

      $count=0;     
      foreach($query->result() as $r) {
			$btn  = '<div class="btn-group" data-toggle="buttons">';
      		$btn  .= '<a href="'.base_url().'role/edit/'.$r->id.'" class="btn btn-primary btn-icon">';
      		$btn .= '<i class="fa fa-pencil-alt"></i>';
      		$btn .= '</a>';
      		$btn  .= '<button onClick="deleted(this.id)" id="'.$r->id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
      		$btn .= '</button>';
			$btn .= '</div>';
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
			/************** Logs ******************/
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Added New Role";
			$this->create_logs('Role Area',$message);
			/**************Ends Logs ******************/
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
		/*********************Logs*************************/
		$this->db->select("*");
		$this->db->from("ps_role");
		$this->db->where('ps_role.id', $id);
		$prev = $this->db->get()->result();
		$prev_data = (array) $prev[0];
		$update = $this->Home_models->update_globl('ps_role',$id,$editData);
		$return_arr = array();
		if($update>0){
		$id= $this->input->post('id');
		$this->db->select("*");
		$this->db->from("ps_role");
		$this->db->where('ps_role.id', $id);
		$updated= $this->db->get()->result();
		$updated_data = (array) $updated[0];
	    $newValues=array_diff_assoc($updated_data,$prev_data);
		$oldValues=array_diff_assoc($prev_data,$updated_data);
		 foreach ($newValues as $key => $value) {
					$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
                    $message = $username." Updated ".$key." From ".$oldValues[$key]." To ".$value;
                    $this->create_logs('Role Area',$message);
                }
         /*********************Logs End*************************/
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
						   ps_user_login.status,
						   ps_user_login.ip_allow,
						   ps_team.name as user_team, 
						   ps_role.name as user_role, 
						   ps_department.name as user_department,
						   managers.first_name_real as first_name_real_manager,
						   managers.last_name_real as last_name_real_manager,
						   team_leads.first_name_real as first_name_real_team_lead,
						   team_leads.last_name_real as last_name_real_team_lead,

			");
		$this->db->from("ps_user_profile");
		$this->db->join('ps_user_login', 'ps_user_profile.id = ps_user_login.id');
		$this->db->join('ps_team', 'ps_user_profile.team = ps_team.id','left');
		$this->db->join('ps_role', 'ps_user_profile.role = ps_role.id','left');
		$this->db->join('ps_department', 'ps_user_profile.department = ps_department.id','left');
		$this->db->join('ps_user_profile as managers', 'ps_user_profile.manager = managers.fk_parent_id','left');
		$this->db->join('ps_user_profile as team_leads', 'ps_user_profile.team_lead = team_leads.fk_parent_id','left');
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
				$btn  .= '<a href="'.base_url().'user/team/'.$r->id.'" class="btn btn-success btn-icon">';
				$btn .= '<i class="fa fa-plus"></i>';
				$btn .= '</a>';
			}
			$btn  .= '<button onClick="deleted(this.id)" id="'.$r->id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
      		$btn .= '</a>';
			$btn .= '<div>';
			$username_s =  $r->first_name."-".$r->last_name;
			$username_r =  $r->first_name_real."-".$r->last_name_real;
			$manger =  $r->first_name_real_manager."-".$r->last_name_real_manager;
			$team_lead =  $r->first_name_real_team_lead."-".$r->last_name_real_team_lead;

			$user_status = $r->status == 0 ? 'danger' : 'success';
			$user_status_text = $r->status == 0 ? 'Inactive' : 'Active';
			$status = '<span class="badge badge-'.$user_status.' es-label " style="font-size : 13px">'.$user_status_text.'</span>';

			$user_ip_status = $r->ip_allow == 0 ? 'danger' : 'success';
			$user_ip_status_text = $r->ip_allow == 0 ? 'Inactive' : 'Active';
			$ipAllow = '<span class="badge badge-'.$user_ip_status.' es-label " style="font-size : 13px">'.$user_ip_status_text.'</span>';

			$id = '<button onclick="copyToClipboard(this.id)" id='.$r->id.' class="btn btn-primary btn-sm">ID</button>';

			$data[] = array(
                ++$count,
				$id,
                $username_r,
                $username_s,
                $r->user_role,
                $r->user_team,
                $r->user_department,
                $r->employee_id,
                $r->extension,
                $team_lead,
                $manger,
				$status,
				$ipAllow,
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
				$executive = 0;
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
				);
				$adduser2 = $this->Home_models->saverecords('ps_user_profile',$userArray2);
				// echo $this->db->last_query();
				if($adduser2 > 0){
					$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
					$message = $username." is Added New User";
					$this->create_logs('User Area',$message);
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
		$data['manger'] = $this->Home_models->selectrecords('ps_user_profile');
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
		$allow_ip = !isset($_POST['allow_ip']) ? '0' : '1';
		$is_active = !isset($_POST['status']) ? '0' : '1';
		/*********************Logs*************************/
		/*********************get user login data*************************/
		$this->db->select("*");
		$this->db->from("ps_user_login");
		$this->db->where('ps_user_login.id', $user_id);
		$prev1 = $this->db->get()->result();
		$prev_data1 = (array) $prev1[0];
		/*********************get user profile data*************************/
		$this->db->select("*");
		$this->db->from("ps_user_profile");
		$this->db->where('ps_user_profile.id', $user_id);
		$prev2 = $this->db->get()->result();
		$prev_data2 = (array) $prev2[0];

		/*********************Logs*************************/
		if($password == ''){
			$data = array(
				'user_name' => $user_name,
				'status'=>"$is_active",
				'ip_allow'=>"$allow_ip"
			);
		}else{
			$data = array(
				'user_name' => $user_name,
				'password' => md5($password),
				'status'=>"$is_active",
				'ip_allow'=>"$allow_ip"
			);
		}
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
		if($role == '1'){
				$data1['manager'] = '0';
		}
		if($role == '2'){
			$data1['team_lead'] = '0';
			$data1['manager'] = $_POST['manager'];
		}
		if($role == '3'){
			$data1['team_lead'] = $_POST['team_leads'];
			$data1['manager'] = $_POST['manager'];
		}
		$this->db->where('id', $user_id);
		$this->db->update('ps_user_login', $data);

		$this->db->where('fk_parent_id', $user_id);
		$this->db->update('ps_user_profile', $data1);
			/*********************Logs user login get after update*************************/
			$this->db->select("*");
			$this->db->from("ps_user_login");
			$this->db->where('ps_user_login.id', $user_id);
			$updated1= $this->db->get()->result();
			$updated_data1 = (array) $updated1[0];
			$newValues1=array_diff_assoc($updated_data1,$prev_data1);
			$oldValues1=array_diff_assoc($prev_data1,$updated_data1);
			 foreach ($newValues1 as $key1 => $value1) {
						$username1 = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message1 = $username1." Updated ".$key1." From ".$oldValues1[$key1]." To ".$value1;
						$this->create_logs('User Area',$message1);
					}
			  /*********************Logs user Profile get after update*************************/      
			 $this->db->select("*");
			$this->db->from("ps_user_profile");
			$this->db->where('ps_user_profile.id', $user_id);
			$updated2= $this->db->get()->result();
			$updated_data2 = (array) $updated2[0];
			$newValues2=array_diff_assoc($updated_data2,$prev_data2);
			$oldValues2=array_diff_assoc($prev_data2,$updated_data2);
			 foreach ($newValues2 as $key2 => $value2) {
						$username2 = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message2 = $username2." Updated ".$key2." From ".$oldValues2[$key2]." To ".$value2;
						$this->create_logs('User Area',$message2);
					}
			 /*********************Logs End*************************/
	
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
		$team_lead_id = $_POST['team_lead_id'];
		$get_current_team_lead_manger['fk_parent_id'] = $team_lead_id;
		$get_manager = $this->Home_models->selectrecords('ps_user_profile',$get_current_team_lead_manger);
		$manager_id = $get_manager[0]['manager'];
		if($action == 'update_team_lead'){
			$update_array = array('team_lead'=>$team_lead_id,'manager'=>$manager_id);
			foreach($_POST['users'] as $user_id){
				$create_user_ids = $user_id;
				$this->db->where('fk_parent_id', $create_user_ids);
				$this->db->update('ps_user_profile', $update_array);
			}
			$return_arr[] = array("Type" => "Success","Error_type" => "User","msg"=>"User Assigned");
			echo json_encode($return_arr);
			die();
		}else if($action == 'update_manager'){

			$update_array = array('manager'=>$_POST['team_lead_id']);

			foreach($_POST['users'] as $team_lead_id){

				$get_users['team_lead'] = $team_lead_id;
				$team_lead_array = array('manager'=>$_POST['team_lead_id']);
				$get_team_lead = $this->Home_models->selectrecords('ps_user_profile',$get_users);

				foreach($get_team_lead as $user){
					$create_inner_user_id = $user['fk_parent_id'];
					$this->db->where('fk_parent_id', $create_inner_user_id);
					$this->db->update('ps_user_profile', $team_lead_array);
				}
				

				$create_user_ids = $team_lead_id;
				$this->db->where('fk_parent_id', $create_user_ids);
				$this->db->update('ps_user_profile', $update_array);
			}

		}
		/*********************Logs*************************/
		$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
		$message = $username." is Updated User Team On User Id ".$team_lead_id;
		$this->create_logs('User Area',$message);
		 /*********************Logs End*************************/
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
		/*********************Logs*************************/
		$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
		$message = $username." is Updated Assign Website On User Id = ".$id;
		$this->create_logs('User Area',$message);
		 /*********************Logs End*************************/
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
			/*********************Logs*************************/
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Updated Remove Website On User Id = ".$user_id ;
			$this->create_logs('User Area',$message);
			/*********************Logs End*************************/
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
		pw.name as website_name
		");
		$this->db->from("ps_leads as pl");
		$this->db->join('ps_customers as pc', 'pl.id = pc.lead_id');
		$this->db->join('ps_team as pt', 'pl.team_id = pt.id');
		$this->db->join('ps_user_profile as pup', 'pup.fk_parent_id = pl.created_by','left');
		$this->db->join('ps_leads_status as pls', 'pls.id = pl.lead_status');
		$this->db->join('ps_website as pw', 'pw.id = pl.website_id');
		$this->db->where('pl.display_id !=' ,"0");
		$this->db->order_by("pl.id","desc"); 
		$query = $this->db->get();
		$data = [];

      $count=0;     
      foreach($query->result() as $r) {

		$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->lead_id.'" onclick="edit_leads(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn .= '<button id="'.$r->lead_id.'" onclick="view(this.id)" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button>';
			$btn .= '<button id="'.$r->lead_id.'" onclick="history(this.id)" class="btn btn-success btn-sm"><i class="fas fa-history"></i></button>';
			$btn .= '<button onClick="deleted(this.id)" id="'.$r->lead_id.'" class="btn btn-danger btn-icon">';
			$btn .= '<i class="fa fa-trash"></i>';
			$btn .= '</button>';
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
                $btn_status,
                $r->website_name,
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
						/*********************Logs*************************/
						$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message = $username." is Added New Lead";
						$this->create_logs('Lead Area',$message);
						/*********************Logs End*************************/
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
				/*********************Logs*************************/
				$this->db->select("*");
				$this->db->from("ps_leads");
				$this->db->where('ps_leads.id', $lead_id);
				$query = $this->db->get()->result();
				$l_code=$query[0]->lead_code;
				$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
				$message = $username." is Added comments On ".$l_code;
				$this->create_logs('Leads Area',$message);
				 /*********************Logs End*************************/
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
				/*********************Logs*************************/
				$this->db->select("*");
				$this->db->from("ps_leads");
				$this->db->where('ps_leads.id', $lead_id);
				$query = $this->db->get()->result();
				$l_code=$query[0]->lead_code;
				$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
				$message = $username." is Added Ownership Comment On ".$l_code;
				$this->create_logs('Leads Area',$message);
				 /*********************Logs End*************************/
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
						/*********************Logs*************************/
						$this->db->select("*");
						$this->db->from("ps_leads");
						$this->db->where('ps_leads.id', $lead_id);
						$query = $this->db->get()->result();
						$l_code=$query[0]->lead_code;
						$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message = $username." is Added Add Chat Comment & File On ".$l_code;
						$this->create_logs('Leads Area',$message);
						 /*********************Logs End*************************/
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
		$this->db->where('pw.display_id !=' ,"0");
		$this->db->join('ps_team as pt', 'pw.team = pt.id','left');
		$this->db->join('ps_user_profile as pup', 'pup.fk_parent_id = pw.created_by','left');
		$this->db->order_by("pw.id","desc"); 
		$query = $this->db->get();
		$data = [];
      	$count=0;     
      	foreach($query->result() as $r) {
			$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->website_id.'" onclick="edit_website(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn  .= '<button onClick="deleted(this.id)" id="'.$r->website_id.'" class="btn btn-danger btn-icon">';
				$btn .= '<i class="fa fa-trash"></i>';
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
						/*********************Logs*************************/
						$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message = $username." is Added New Website";
						$this->create_logs('Website Area',$message);
						/*********************Logs End*************************/
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
			    /*********************Logs*************************/
				$this->db->select("*");
				$this->db->from("ps_website");
				$this->db->where('ps_website.id',$id);
				$query = $this->db->get()->result();
				$w_id=$query[0]->id;
				$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
				$message = $username." is Added Change Team On Website Id = ".$w_id;
				$this->create_logs('Website Area',$message);
				/*********************Logs End*************************/
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
				 /*********************Logs*************************/
				$this->db->select("*");
				$this->db->from("ps_website");
				$this->db->where('ps_website.id',$id);
				$query = $this->db->get()->result();
				$w_id=$query[0]->id;
				$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
				$message = $username." is Added Change Type On Website Id = ".$w_id;
				$this->create_logs('Website Area',$message);
				/*********************Logs End*************************/
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
			/*********************Logs*************************/
			$this->db->select("*");
			$this->db->from("ps_website");
			$this->db->where('ps_website.id',$id);
			$query = $this->db->get()->result();
			$w_id=$query[0]->id;
			$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
			$message = $username." is Added Change Status On Website Id = ".$w_id;
			$this->create_logs('Website Area',$message);
			/*********************Logs End*************************/
				$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data SuccessFully Updated");
			}else{
				$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
			}
			echo json_encode($return_arr);
			
		}else{
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
		pw.name as website,
		ld.id as lead_id,
		ld.lead_code,
		pt.id as team_id,
		pt.name as team_name,
		pup.id as user_id,
		Concat(pup.first_name,' - ',pup.last_name) as username
		
		");
		$this->db->from("ps_invoice_basic as inv");
		$this->db->join('ps_leads as ld', 'ld.id= inv.lead_id');
		$this->db->join('ps_team as pt', 'pt.id = inv.team');
		$this->db->join('ps_user_profile as pup', 'pup.id  = inv.added_by');
		$this->db->join('ps_website as pw', 'pw.id  = inv.website');
		$this->db->where('inv.display_id','1');
		$this->db->order_by("inv.id","desc"); 
		$query = $this->db->get();
		$data = [];
		$count=0;
		foreach($query->result() as $r) {
			$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->invoice_id.'" onclick="edit_invoice(this.id,\''.$r->invoice_no.'\')" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn .= '<button id="'.$r->invoice_id.'" onclick="delete_invoice(this.id,\''.$r->invoice_no.'\')" class="btn btn-warning btn-sm"><i class="fas fa-eye"></i></button>';
			$btn .= '<button id="'.$r->invoice_id.'" onclick="history_invoice(this.id,\''.$r->invoice_no.'\')" class="btn btn-success btn-sm"><i class="fas fa-history"></i></button>';
			$btn .= '<button id="'.$r->invoice_id.'" onClick="deleted(this.id)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>';
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
				$r->username,
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
				'status'=>"0",	
					);
			$addivoice = $this->Home_models->saverecords('ps_invoice_basic',$invArray);
			if($addivoice >0){
				/*********************Logs*************************/
				$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
				$message = $username." is Added New Invoice";
				$this->create_logs('Invoice Area',$message);
				/*********************Logs End*************************/
				$data = json_decode($_POST['invoice_detail']);    
				$pdf_content;
				$count = 0;
				foreach ($data as $obj){
				   $service_id= $obj->service;
				   $comment= $obj->comments;
				   $Array = array(
						'invoice_id'=>$addivoice,
						'service_id'=>$service_id,
						'comments'=>$comment	
					);
				    $add_invoice_detail = $this->Home_models->saverecords('ps_invoice_detail',$Array);
					$count++;
					$get_service = $this->getDetilsById('id',$service_id,'ps_services');
					$pdf_content .= '<tr>
						<th> <b>Service '.$count.'</b></th>
						<td>'.$get_service[0]['name'].'</td>
					</tr>';
				}
			}
				$return_arr = array();
			if($add_invoice_detail>0){
				$get_invoice_details = $this->getDetilsById('id',$addivoice,'ps_invoice_basic');
				$inv = $get_invoice_details[0]['invoice_no'];
				$lead_id = $get_invoice_details[0]['lead_id'];
				$get_lead_details = $this->getDetilsById('lead_id',$lead_id,'ps_customers');
				$name = $get_lead_details[0]['name'];
				$email = $get_lead_details[0]['email'];
				$number = $get_lead_details[0]['number'];
				tcpdf();
                $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $obj_pdf->SetCreator(PDF_CREATOR);
                $title = "";
                $obj_pdf->SetTitle($title);
                // $obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title);
                $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $obj_pdf->SetDefaultMonospacedFont('helvetica');
                $obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
                $obj_pdf->SetFont('helvetica', '', 10);
                $obj_pdf->setFontSubsetting(false);
				$obj_pdf->AddPage();
                ob_start();
                    // we can have any view part here like HTML, PHP etc
                ob_end_clean();
				$message2 = '<!DOCTYPE html>
								<html lang="en">
								<head>
									<title>Order Details</title>
									<style>
										table{
											background:red !important;
										}
									</style>
								</head>
								<body>
									<h4 style="text-align: center;background-color: #a7a7a7;color: black;padding: 4px;">Invoice DETAILS </h4>
									<div class="height:200px"></div>	
									<h5 style="text-align: center;background-color: black;padding: 4px;color: white;">INVOICE NO = " '.$inv.'  "</h5>
										<div class="height:200px"></div>
										<table style="text-align: center;border:1px;color: black;padding: 4px;">
										<thead>
										<tr>
											<th><b>Name</b></th>
											<th><b>Email</b></th>
											<th><b>Phone</b></th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td>'.$name.'</td>
											<td>'.$email.'</td>
											<td>'.$number.'</td>
										</tr>
										</tbody>
									</table>
									<table style="text-align: center;border:1px;color: black;padding: 4px;font-size:12px !important;">
									'.$pdf_content.'
									</table>
								</body>
							</html>
							';
                $title2 = "Journey2oftest";
                $title2 = str_replace(".com ","",$title2);
                $obj_pdf->writeHTML($message2, true, false, true, false, '');
                $obj_pdf->AddPage();
                $url = 'C:/xampp/htdocs/estudentarea/dynamic/uploads/invoice/'.$inv.'.pdf';
                
                $obj_pdf->Output($url, 'F');
			$return_arr[] = array("Type" => "Success","Error_type" => "Invoice","msg"=>"Data Success Fully Inserted");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "Invoice","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
	}
	public function invoice_customer_details(){
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
						<th>.</th>
						<th>Name</th>
						<th>Email</th>
						<th>Number</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<input type="checkbox">
						</td>
						<td>
							<label>'.$data['customer_name'].'</label>
						</td>
						<td>
							<label>'.$data['customer_email'].'</label>
						</td>
						<td>
							<label>'.$data['customer_no'].'</label>
						</td>
						<input type="hidden" name="id"  id="cus-id" value='.$data['lead_id'].'>
					</tr>
				</tbody>
			</table>';
		}
    }
	public function invoice_action(){
		$send_array = $_POST;
		$filter['id'] = $_POST['id'];
		$get_inv_details = $this->Home_models->selectrecords('ps_invoice_basic',$filter);
		$website['id'] = $get_inv_details[0]['website'];
		$send_array['website'] = $this->Home_models->selectrecords('ps_website',$website);
		$this->load->view('invoice/tab',$send_array);
	}
	public function invoice_action_response(){
		$userid  = $_SESSION['user_profile'][0]['fk_parent_id'];
		$username = $_SESSION['user_profile'][0]['first_name']." - ". $_SESSION['user_profile'][0]['last_name'];

		$id= $_POST['inv_id'];
		$amount['amount']  = $_POST['amount']."".$_POST['point_amount'];
		$this->Home_models->update_globl('ps_invoice_basic',$id,$amount);
		$track['invoice_id']  = $id;
		$track['user_id']  = $userid;
		$track['message']  = $username. " Updated Amount ". $_POST['amount']."".$_POST['point_amount'];
		$this->Home_models->saverecords('ps_invoice_history',$track);
		/*********************Logs*************************/
		$this->db->select("*");
		$this->db->from("ps_invoice_basic");
		$this->db->where('ps_invoice_basic.id', $id);
		$query = $this->db->get()->result();
		$inv_code=$query[0]->invoice_no;
		$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
		$message = $username." is Updated Amount On ".$inv_code;
		$this->create_logs('Invoice Area',$message);
		/*********************Logs End*************************/
		echo '1';
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
		ord.invoice_id as invoice_id,
		pors.name as p_status,
		pors.status_btn as p_status_btn
		");
		
		$this->db->from("ps_order_main as ord");
		$this->db->where('ord.display_id !=' ,"0");
		$this->db->join('ps_order_child as orc', 'orc.order_id = ord.id');
		$this->db->join('ps_order_production_status as pors', 'orc.production_status = pors.id');
		
		// $this->db->where('orc.display', '1');
		$query = $this->db->get();
			
		$data = [];
		$count=0;     
		foreach($query->result() as $r) {
			$btn = '<div class="btn-group" data-toggle="buttons">';
			$btn .= '<button id="'.$r->id.'" onclick="edit_order(this.id)" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>';
			$btn .= '<button id="'.$r->id.'" onclick="history(this.id)" class="btn btn-warning btn-sm"><i class="fas fa-history"></i></button>';
			$btn .= '<button id="'.$r->id.'" onClick="deleted(this.id)" class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>';
			$btn .='</div>';
			
			$get_service = $this->getDetilsById('id',$r->services,'ps_services');
			$service = $get_service[0]['name'];

			$get_user = $this->getDetilsById('fk_parent_id',$r->assign_to,'ps_user_profile');
			$assign_user = $get_user[0]['first_name']." - ".$get_user[0]['last_name'];

			$get_inv = $this->getDetilsById('id',$r->invoice_id,'ps_invoice_basic');
			$invoice_no = $get_inv[0]['invoice_no'];
			
			$production_status = '<span class="badge '.$r->p_status_btn.' es-label">'.$r->p_status.'</span>';

			$oi = $r->order_code.' / '.$invoice_no;
			$data[] = array(
				++$count,
				$oi,
				$r->view_code,
				"dev role",
				$r->sale_date,
				$r->delivery_date,
				$service,
				$production_status,
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
		$this->load->view('order/tab',$data);
	}
	public function order_action_response(){
		$action = $_POST['action'];
		$id = $_POST['id'];
		if($action == 'assigned_order'){
			$id= $this->input->post('id');
			$writer_id= $this->input->post('writer_name');
			$comments= $this->input->post('comments');
			$assign_by=$_SESSION['user_profile'][0]['id'];
			$Array = array(
					'assign_to'=>$writer_id,
					'assign_by'=>$assign_by,
					'production_status'=>"2"
				);
			$Array1 = array(
					'order_id'=>$id,
					'comment'=>$comments,
					'added_by'=>$assign_by
				);
	        $this->db->where('id', $id);
			$update_order_child= $this->db->update('ps_order_child', $Array);
			$return_arr = array();
			if($update_order_child>0) {
			$add_order_history = $this->Home_models->saverecords('ps_order_history',$Array1);
				if($add_order_history>0){
					/*********************Logs*************************/
					$this->db->select("*");
					$this->db->from("ps_order_main");
					$this->db->where('ps_order_main.id', $id );
					$query = $this->db->get()->result();
					$O_code=$query[0]->order_code;
					$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
					$message = $username." is Added Assign Order On ".$O_code;
					$this->create_logs('Order Area',$message);
					/*********************Logs End*************************/
					$return_arr[] = array("Type" => "Success","Error_type" => "Role","msg"=>"Data Success Fully Updated");
				}else{
					$return_arr[] = array("Type" => "Error","Error_type" => "Role","msg"=>"Server Error");
				}
			}
			echo json_encode($return_arr);
		}else if($action == 'comment_order'){
			$filter['id']= $id;
			$row_order_history = $this->Home_models->selectrecords('ps_order_child',$filter);
			$writer_id= $this->input->post('writer_name');
			$comments= $this->input->post('comments');
			$assign_by=$_SESSION['user_profile'][0]['id'];
			$lead_code_filter = array('order_id	' => $id, 'files!=' => '');
			$this->db->select('count(*) as count');
			$this->db->from("ps_order_history");
			$this->db->where($lead_code_filter);
			$query = $this->db->get()->result();
			$history_count = $query[0]->count;
			$file_name  = $history_count == 0 ? 1 : $history_count +1 ;
			$new_code = $row_order_history[0]['view_code'].'-'.$file_name;
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
							// die();
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
					$order_history_table = array(
						'order_id'=>$id,
						'comment'=>$comments,
						'added_by'=>$assign_by,
						'files' =>$receipt_path,
						'status'=>'1',
					);
					$order_history_add = $this->Home_models->saverecords('ps_order_history',$order_history_table);
					if($order_history_add > 0){
						/*********************Logs*************************/
						$this->db->select("*");
						$this->db->from("ps_order_main");
						$this->db->where('ps_order_main.id', $id );
						$query = $this->db->get()->result();
						$O_code=$query[0]->order_code;
						$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message = $username." is Added Comment Order On ".$O_code;
						$this->create_logs('Order Area',$message);
						/*********************Logs End*************************/
						echo '1';
					}else{
						echo '0';
					}
				}
		}else if($action == 'submit_order'){	
			$filter['id']= $id;
			$row_order_history = $this->Home_models->selectrecords('ps_order_child',$filter);
			$writer_id= $this->input->post('writer_name');
			$comments= $this->input->post('comments');
			$assign_by=$_SESSION['user_profile'][0]['id'];
			$lead_code_filter = array('order_id	' => $id, 'files!=' => '');
			$this->db->select('count(*) as count');
			$this->db->from("ps_order_history");
			$this->db->where($lead_code_filter);
			$query = $this->db->get()->result();
			$history_count = $query[0]->count;
			$file_name  = $history_count == 0 ? 1 : $history_count +1 ;
			$new_code = $row_order_history[0]['view_code'].'-'.$file_name;
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
							// die();
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
				$Array = array(	
						'production_status'=>"3"
					);
	             $this->db->where('id', $id);
		       $update_order_child= $this->db->update('ps_order_child', $Array);

		       if($update_order_child>0) {

       	 			$order_history_table = array(
						'order_id'=>$id,
						'comment'=>$comments,
						'added_by'=>$assign_by,
						'files' =>$receipt_path,
						'status'=>'1',
					);
					$order_history_add = $this->Home_models->saverecords('ps_order_history',$order_history_table);
					if($order_history_add > 0){
						/*********************Logs*************************/
						$this->db->select("*");
						$this->db->from("ps_order_main");
						$this->db->where('ps_order_main.id', $id );
						$query = $this->db->get()->result();
						$O_code=$query[0]->order_code;
						$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
						$message = $username." is Added Submit Order On ".$O_code;
						$this->create_logs('Order Area',$message);
						/*********************Logs End*************************/
						echo '1';
					}else{
						echo '0';
					}
       		}
				
				}
		}else if($action == 'update_order'){	
			$filter['id']= $id;
			$row_order_history = $this->Home_models->selectrecords('ps_order_child',$filter);
			$order_status= $this->input->post('order_status');
			$comments= $this->input->post('comments');
			$assign_by=$_SESSION['user_profile'][0]['id'];
			$lead_code_filter = array('order_id	' => $id, 'files!=' => '');
			$this->db->select('count(*) as count');
			$this->db->from("ps_order_history");
			$this->db->where($lead_code_filter);
			$query = $this->db->get()->result();
			$history_count = $query[0]->count;
			$file_name  = $history_count == 0 ? 1 : $history_count +1 ;
			$new_code = $row_order_history[0]['view_code'].'-'.$file_name;
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
							// die();
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
				$Array = array(	
						'production_status'=>$order_status,
						'support_status'=>$order_status
					);
	             $this->db->where('id', $id);
		       $update_order_child= $this->db->update('ps_order_child', $Array);

		       if($update_order_child>0) {
		       	/*********************Logs*************************/
					$this->db->select("*");
					$this->db->from("ps_order_main");
					$this->db->where('ps_order_main.id', $id );
					$query = $this->db->get()->result();
					$O_code=$query[0]->order_code;
					$username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
					$message = $username." is Added Update Order On ".$O_code;
					$this->create_logs('Order Area',$message);
					 /*********************Logs End*************************/

       	 			$order_history_table = array(
						'order_id'=>$id,
						'comment'=>$comments,
						'added_by'=>$assign_by,
						'files' =>$receipt_path,
						'status'=>'1',
					);
					$order_history_add = $this->Home_models->saverecords('ps_order_history',$order_history_table);
					if($order_history_add > 0){
						echo '1';
					}else{
						echo '0';
					}
       		}
				
				}
			}
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

	
	/************** Ip ******************/
	public function ip_address(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('ip_address/index',$data);
		$this->load->view('ip_address/_js');
	}
	public function ip_address_response(){
		$draw 	= intval($this->input->get("draw"));
		$start 	= intval($this->input->get("start"));
		$length 	= intval($this->input->get("length"));
		$this->db->select("ps_ip_allowed.id as id,
							ps_ip_allowed.ip,
							ps_ip_allowed.created_at,
							concat(ps_user_profile.first_name,ps_user_profile.last_name) as username
						");
		$this->db->from("ps_ip_allowed");
		$this->db->join('ps_user_profile', 'ps_user_profile.id = ps_ip_allowed.added_by');
		$this->db->where('ps_ip_allowed.status != ','0');
		$this->db->order_by("ps_user_profile.id","desc"); 
		$query = $this->db->get();
		$data = [];

		$count=0;     
		foreach($query->result() as $r) {
				$btn = '<div class="btn-group" data-toggle="buttons">'; 
				$btn .= '<a href="'.base_url().'ip_address/edit/'.$r->id.'" class="btn btn-primary btn-icon">';
				$btn .= '<i class="fa fa-pencil-alt"></i>';
				$btn .= '</a>';
				$btn .= '<button onclick="deleted(this.id)" id='.$r->id.' class="btn btn-danger btn-icon"><i class="fa fa-trash"></i></button>';
				$btn .= '</div>';
				
				$data[] = array(
					++$count,
					$r->ip,
					$r->username,
					// $r->created_at,
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
	public function ip_address_add(){
		$data['role'] = $this->Home_models->selectrecords('ps_role');
		$data['team'] = $this->Home_models->selectrecords('ps_team');
		$data['menu'] = $this->MenuModel->category_menu(1);
		$this->load->template('ip_address/add',$data);
    	$this->load->view('ip_address/_js');
	}
	public function ip_address_add_response(){
		$ip_arra['ip'] = $_POST['IP'];
		$ip_arra['added_by'] = $_SESSION['user_profile'][0]['id'];
		$addIp = $this->Home_models->saverecords('ps_ip_allowed',$ip_arra);
		$return_arr = array();
		if($addIp > 0){
			$return_arr[] = array("Type" => "Success","Error_type" => "department","msg"=>"Data Success Fully Inserted");
		}else{
			$return_arr[] = array("Type" => "Error","Error_type" => "department","msg"=>"Server Error");
		}
		echo json_encode($return_arr);
    }
	public function ip_address_edit($id = null){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$filter['id'] = $id;
		$data['ip_details'] = $this->Home_models->selectrecords('ps_ip_allowed',$filter);
		$this->load->template('ip_address/edit',$data);
		$this->load->view('ip_address/_js');
	}
	public function ip_address_edit_response(){
		$id 		 	= $_POST['current_id'];
		$ip 		 	= $_POST['IP'];
		$data = array(
			'ip' => $ip,
		);
		$this->db->where('id', $id);
		$this->db->update('ps_ip_allowed', $data);
		$return_arr[] = array("Type" => "Success","Error_type" => "User","msg"=>"Data Success Fully Updated");
		echo json_encode($return_arr);
	}

	///*******/////
	public function permissions(){
		$data['menu'] = $this->MenuModel->category_menu(1);
		$data['department'] = $this->Home_models->selectrecords('ps_department');
		$this->load->template('permissions/index',$data);
		$this->load->view('permissions/_js');
	}
	public function getPermissions(){

    //print_r($_POST);
    $role_id = $_POST["role_id"];
    $departmentDiv = $_POST['departmentDiv'];
    $array = array('ps_menu_access.role_id'=>$role_id,'ps_menu_access.depart_id'=>$departmentDiv);
    $this->db->select('ps_menu_access.menu_id,ps_menu.name,ps_menu.add_access,ps_menu.edit_access,ps_menu.delete_access,ps_menu.view_access,ps_menu_access.add_acces as menu_add_access,ps_menu_access.edit_access as menu_edit_access,ps_menu_access.delete_access as menu_delete_access,ps_menu_access.view_access as menu_view_access');
    $this->db->from('ps_menu_access');
    $this->db->join('ps_menu', 'ps_menu.id = ps_menu_access.menu_id');
    $this->db->where($array);
    //$this->db->join('et_city', 'et_city.id = et_broker.city_id');
    $query = $this->db->get();
    ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Permission Name</th>
          <th>Add Permission</th>
          <th>Edit Permission</th>
          <th>Delete Permission</th>
          <th>View Permission</th>
        </tr>
      </thead>
    <?php
    foreach($query->result() as $r) {
    ?>
    
      <tr>
        <td>
          <div class="checkbox-fade fade-in-primary">
            <input type="checkbox" <?php if($r->menu_add_access==1 && $r->menu_edit_access==1 && $r->menu_delete_access==1 && $r->menu_view_access==1){echo "checked";}?> value="1" name="<?=$r->menu_id?>[all_acccess]" onClick="check_all(this.id)" id="<?=$r->menu_id?>" class="option-input checkbox">
          </div>
        </td>
        <td><?=$r->name?></td>
        <td>
          <div class="checkbox-fade fade-in-primary" <?php if($r->add_access==1){}else{
            echo "style='display:none';";
          }?>>
            <input type="checkbox" <?php if($r->menu_add_access==1){echo "checked";}?> value="1" name="<?=$r->menu_id?>[add_access]" id="add_access_<?=$r->menu_id?>" class="option-input checkbox">
          </div>
        </td>
        <td>
          <div class="checkbox-fade fade-in-primary" <?php if($r->edit_access==1){}else{
            echo "style='display:none';";
          }?>>
            <input type="checkbox" value="1" <?php if($r->menu_edit_access==1){echo "checked";}?> name="<?=$r->menu_id?>[edit_access]" id="edit_access_<?=$r->menu_id?>" class="option-input checkbox">
          </div>
        </td>
        <td>
          <div class="checkbox-fade fade-in-primary" <?php if($r->delete_access==1){}else{
            echo "style='display:none';";
          }?>>
            <input type="checkbox" value="1" <?php if($r->menu_delete_access==1){echo "checked";}?> name="<?=$r->menu_id?>[delete_access]" id="delete_access_<?=$r->menu_id?>" class="option-input checkbox">
          </div>
        </td>
        <td>
          <div class="checkbox-fade fade-in-primary" <?php if($r->view_access==1){}else{
            echo "style='display:none';";
          }?>>
            <input type="checkbox" value="1" <?php if($r->menu_view_access==1){echo "checked";}?> name="<?=$r->menu_id?>[view_access]" id="view_access_<?=$r->menu_id?>" class="option-input checkbox">
          </div>
        </td>
      </tr>
    
    <?php
    }?>
    <tr>
      <td colspan="6" style="text-align: end;">
        <button class="btn btn-primary btn-round" type="submit">Save</button>
      </td>
    </tr>
    </table>
    <?php
  }
  public function permission_proces(){
  	//print_r($_POST);
  	foreach($_POST as $key=>$value){
  		$add_access  	= 0;
  		$edit_access 	= 0;
  		$delete_access 	= 0;
  		$view_access 	= 0;
  		$role_id 		= $this->input->post('role_id');
  		$depart_id 		= $this->input->post('depart_id');
  		if(isset($_POST[$key]['add_access'])){
  			$add_access = 1;
  		}
  		if(isset($_POST[$key]['edit_access'])){
  			$edit_access = 1;
  		}
  		if(isset($_POST[$key]['delete_access'])){
  			$delete_access = 1;
  		}
  		if(isset($_POST[$key]['view_access'])){
  			$view_access = 1;
  		}
  		$array = array(
  			'add_acces'	=>$add_access,
  			'edit_access'	=>$edit_access,
  			'delete_access'	=>$delete_access,
  			'view_access'	=>$view_access
  		);
  		$where_array = array(
  			"role_id"=>$role_id,
  			"depart_id"=>$depart_id,
  			"menu_id"=>$key
  		);
  		$this->db->set($array);
        $this->db->where($where_array);
        $this->db->update('ps_menu_access', $array);
        echo $this->db->last_query();
  	}
  }
	
}