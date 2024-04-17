<?php
class Enquiry_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    public function save_enquiry($data) {
        // Attempt to insert data into the database
        $this->db->insert('enquiries', $data);
        
        // Check if the insertion was successful
        if ($this->db->affected_rows() > 0) {
            // Return the ID of the newly inserted enquiry
            return $this->db->insert_id();
        } else {
            // Log the database error
            $error_message = $this->db->error();
            log_message('error', 'Failed to save enquiry: ' . $error_message['message']);
            
            // Return false to indicate failure
            return false;
        }
    }
    
}
?>
