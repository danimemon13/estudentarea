<?php
class Home_models extends CI_Model 
{
	function selectrecords($table,$column=0,$data=0,$orderby=0,$xlumn=0)
	{   
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
        return $query->result_array();  
    }
    function saverecords($table,$data)
    {
        // print_r($data);
        // die();
        $this->db->insert($table,$data);
        return $this->db->insert_id();
        
    }
}
?>