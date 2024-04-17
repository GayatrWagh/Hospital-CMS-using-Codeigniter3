<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointments_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('appointments',$formArray);
    }

    public function getAppointments($params = [])
    {
        $limit = isset($params['limit']) ? $params['limit'] : null;
        $offset = isset($params['offset']) ? $params['offset'] : null;
    
        if (isset($params['q'])) {
            $this->db->or_like('name', trim($params['q']));
        }
    
        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }
    
        $query = $this->db->get('appointments');
        $result = $query->result_array(); 
        return $result;
    }
    function getAppointmentsCount($param = array())
{
    if(isset($param['q']))
    {
        $this->db->or_like('name', trim($param['q']));
       
    }
    $count = $this->db->count_all_results('appointments');
    return $count;
}
    public function getAppointment($id)
    {
        $this->db->where('id',$id);
        $appointment=$this->db->get('appointments')->row_array();
           //select * from appointments where id={ID}
        return $appointment;
    }

    public function update($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('appointments',$formArray);

    }
    
// Front Functions

public function getAppointmentsFront($params=[]){
    // $this->db->where('abouts.status',1);
    $result=$this->db->get('appointments')->result_array();
//    echo $this->db->last_query();
    return $result;

}
public function updateStatus($id, $status) {
    $this->db->where('id', $id);
    $this->db->update('appointments', array('status' => $status));
    return $this->db->affected_rows() > 0; // Return true if any row was affected
}

    
}
?>