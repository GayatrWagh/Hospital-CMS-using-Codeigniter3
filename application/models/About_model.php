<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('abouts',$formArray);
    }

    public function getAbouts($params=[]){
        if(!empty($params['queryString']))
        {
            $this->db->like('title',$params['queryString']);

        }
       $result=$this->db->get('abouts')->result_array();
    //    echo $this->db->last_query();
       return $result;

    }
    public function getAbout($id)
    {
        $this->db->where('id',$id);
        $about=$this->db->get('abouts')->row_array();
           //select * from abouts where id={ID}
        return $about;
    }

    public function update($id,$formArray)
    {
        $this->db->where('id',$id);
        $this->db->update('abouts',$formArray);

    }
    
// Front Functions

public function getAboutsFront($params=[]){
    // $this->db->where('abouts.status',1);
    $result=$this->db->get('abouts')->result_array();
//    echo $this->db->last_query();
    return $result;

}

    
}
?>