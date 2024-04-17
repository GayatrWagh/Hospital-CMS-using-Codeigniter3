<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiries_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('enquiries',$formArray);
    }

  

    public function getEnquiries($params = [])
    {
        $limit = isset($params['limit']) ? $params['limit'] : null;
        $offset = isset($params['offset']) ? $params['offset'] : null;
    
        if (isset($params['q'])) {
            $this->db->like('name', trim($params['q']));
        }
    
        if ($limit !== null && $offset !== null) {
            $this->db->limit($limit, $offset);
        }
    
        $query = $this->db->get('enquiries');
        $result = $query->result_array();
        return $result;
    }
    
    function getEnquiriesCount($param = array())
{
    if(isset($param['q']))
    {
        $this->db->or_like('name', trim($param['q']));
       
    }
    $count = $this->db->count_all_results('enquiries');
    return $count;
}
    public function getEnquiry($id)
    {
        $this->db->where('id',$id);
        $enquiry=$this->db->get('enquiries')->row_array();
           //select * from enquiries where id={ID}
        return $enquiry;
    }

    public function update($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('enquiries',$formArray);

    }
    
// Front Functions

public function getEnquiriesFront($params=[]){
    // $this->db->where('abouts.status',1);
    $result=$this->db->get('enquiries')->result_array();
//    echo $this->db->last_query();
    return $result;

}
public function updateStatus($id, $status) {
    $this->db->where('id', $id);
    $this->db->update('enquiries', array('status' => $status));
}

    
}
?>