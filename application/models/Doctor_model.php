<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_Model {

    function getDoctor($id)
    { 
        $this->db->where('id',$id);
        $query=$this->db->get('doctors');
        $doctor=$query->row_array(); 
        //aSELECT * FROM doctors WHERE id={'id'}
        return $doctor;


    }

    function getDoctors($param = array())
{ 
    if(isset($param['per_page']) && isset($param['offset']))
    {
        $this->db->limit($param['per_page'], $param['offset']);
    }
    if(isset($param['q']))
    {
        $this->db->or_like('name', trim($param['q']));
        $this->db->or_like('designation', trim($param['q']));
    }

    $query = $this->db->get('doctors');
    $doctors = $query->result_array();
    return $doctors;
}
public function getDoctorsByDepartment($department_id) {
    $this->db->select('*');
    $this->db->where('department', $department_id);
    $query = $this->db->get('doctors');

    if ($query) {
        $doctors = $query->result_array();
        return $doctors;
    } else {
        log_message('error', 'Failed to fetch doctors: ' . $this->db->error()['message']);
        return false;
    }
}
function getDoctorsCount($param = array())
{
    if(isset($param['q']))
    {
        $this->db->or_like('name', trim($param['q']));
        $this->db->or_like('designation', trim($param['q']));
    }
    $count = $this->db->count_all_results('doctors');
    return $count;
}
    function addDoctor($formArray)
    {
        $this->db->insert('doctors',$formArray);
        return $this->db->insert_id();

    }

    function updateDoctor($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('doctors',$formArray);


    }

    function deleteDoctor($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('doctors');
 
    }                                                                                                                                                                        
            
          // front methods//


        function getDoctorsFront($param = array())
        {
            if(isset($param['offset']) && isset($param['limit']))
            {
                $this->db->limit($param['offset'], $param['limit']);
            }
            if(isset($param['q']))
            { 
                $this->db->or_like('name', trim($param['q']));
                $this->db->or_like('designation', trim($param['q']));
            }
            $this->db->select('doctors.*,departments.name as department_name');
            $this->db->where('doctors.status',1);
            $this->db->order_by('doctors.created_at','DESC');   
            $this->db->join('departments','departments.id=doctors.department','left');                                                                                                               
            $query = $this->db->get('doctors');
            $doctors = $query->result_array();

            //echo $this->db->last_query();
            return $doctors;
        }

}
?>