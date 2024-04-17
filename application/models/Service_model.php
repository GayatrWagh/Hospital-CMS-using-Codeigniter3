<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service_model extends CI_Model {
    public function create($formArray)
    {
        $this->db->insert('services', $formArray);
    }

    public function getServices($params = [])
    {
        if (!empty($params['queryString'])) {
            $this->db->like('service_name', $params['queryString']);
        }
        
        $result = $this->db->get('services')->result_array();
        return $result;
    }

    public function getServiceTitles($params = [])
    {
        if (!empty($params['queryString'])) {
            $this->db->like('title', $params['queryString']);
        }
        
        $result = $this->db->get('service_title')->result_array();
        return $result;
    }

    public function getServiceTitle($id)
    {
        $this->db->where('id', $id);
        $service_title = $this->db->get('service_title')->row_array();
        return $service_title;
        
    }

    public function updateTitle($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('service_title', $formArray);
    }

    public function getService($id)
    {
        $this->db->where('id', $id);
        $service = $this->db->get('services')->row_array();
        return $service;
    }

    public function update($id, $formArray)
    {
        $this->db->where('id', $id);
        $this->db->update('services', $formArray);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('services');
    }

    // Front Functions

    public function getServicesFront($params = [])
    {
        // $this->db->where('services', 1]);
        // $result= $this->db->get('service_title')->result_array();
        // return $result;
        $result = $this->db->get('services')->result_array();
        return $result;
    }
}
?>
