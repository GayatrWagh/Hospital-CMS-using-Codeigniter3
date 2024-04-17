<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('departments',$formArray);
    }

    public function getDepartments($params=[]){
        if(!empty($params['queryString']))
        {
            $this->db->like('name',$params['queryString']);

        }   
        
        return $this->db->get('departments')->result();

    }
    public function getAllDepartments() {
    $this->db->order_by('name','ASC');
    $query = $this->db->get('departments');
   // print_r($query);
    return $query->result();
    }
    
    public function getDoctorsByDepartment($department_id) {
        $this->db->where('department', $department_id);
        $query = $this->db->get('doctors');
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array(); // Return an empty array if no doctors found for the given department
        }
    }
    public function getDepartment($id)
    {
        $this->db->where('id',$id);
        $department=$this->db->get('departments')->row_array();
           //select * from departments where id={ID}
        return $department;
    }

    public function update($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('departments',$formArray);

    }
    public function delete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('departments');

    }
// Front Functions

public function getDepartmentsFront($params=[]){
    $this->db->where('departments.status',1);
    $result=$this->db->get('departments')->result_array();
//    echo $this->db->last_query();
    return $result;

}

    
}
?>