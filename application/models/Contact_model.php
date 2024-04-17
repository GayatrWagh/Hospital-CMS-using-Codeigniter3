<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('contacts',$formArray);
    }

    public function getContacts($params=[]){
        if(!empty($params['queryString']))
        {
            $this->db->like('title',$params['queryString']);

        }
       $result=$this->db->get('contacts')->result_array();
    //    echo $this->db->last_query();
       return $result;

    }
    public function getContact($id)
    {
        $this->db->where('id',$id);
        $contact=$this->db->get('contacts')->row_array();
           //select * from contacts where id={ID}
        return $contact;
    }

    public function update($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('contacts',$formArray);

    }
    
// Front Functions

public function getContactsFront($params=[]){
    // $this->db->where('abouts.status',1);
    $result=$this->db->get('contacts')->result_array();
//    echo $this->db->last_query();
    return $result;

}

public function insert_enquiry($data) {
    // Insert the data into the "enquiry" table
    $this->db->insert('enquiry', $data);
    return $this->db->insert_id();
}
}
?>