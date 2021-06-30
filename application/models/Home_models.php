<?php
class Home_models extends CI_Model 
{
	function selectrecords($table,$column=0,$data=0,$orderby=0,$xlumn=0){
	    $this->db->select("*");
        $this->db->from("$table");
        
        if($column=="0"){}
        else{
            if($data=="0"){
        	   $this->db->where($column);
            }
            else{
        	   $this->db->where($column,$data);
            }
        }
        
        
        
        if($orderby=="0"){ 
            
        }
        else{
            $this->db->order_by($orderby, $xlumn);
        }
        
        $query = $this->db->get();

        // if(isset($_SESSION['user_profile'])){
        //     $username = $_SESSION['user_profile'][0]['first_name_real']."-".$_SESSION['user_profile'][0]['last_name_real'];
        //     $message = $username." is View Table".$table;
        //     $this->Home->create_logs($table.' Area ',$message);
        // }


        return $query->result_array();  


    }
    function saverecords($table,$data){
        // print_r($data);
        // die();
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    public function edit_function(){
        $table = $_POST["table_name"];
        $id = $_POST["user_id"];
        $array = array();
        foreach($_POST as $key=>$value){
            if($key=='id'){}
            else if($key=='table_name'){}
            else{
                $a=array($key=>$value);
                array_push($array,$a);
                $this->db->where('id', $id);
                $this->db->update($table, $a);
                
            }
        }
        $return_arr[] = array("Type" => "Success","Error_type" => "confirm_password_error","msg"=>"Data Updated");
		echo json_encode($return_arr);
    }
    function delete_globle($table,$id,$data){
        $this->db->where('id', $id);
        if($this->db->update($table,$data))
        {
        return true;
        }
        else {
            return false;
        }
    }
    function update_globl($table,$id,$data){
        $this->db->where('id', $id);
        if($this->db->update($table,$data))
        {
        return true;
        }
        else {
            return false;
        }
    }
}
?>