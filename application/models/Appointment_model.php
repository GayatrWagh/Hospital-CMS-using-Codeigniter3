<?php
class Appointment_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    } 

    public function save_appointment($data) {
        try {
            // Attempt to insert data into the database
            $this->db->insert('appointments', $data);
            
            // Check if the insertion was successful
            if ($this->db->affected_rows() > 0) {
                // Return the ID of the newly inserted appointment
                return $this->db->insert_id();
            } else {
                // Log the database error
                log_message('error', 'Failed to save appointment: No rows affected');
                
                // Return false to indicate failure
                return false;
            }
        } catch (Exception $e) {
            // Log any exceptions that occur during the database operation
            log_message('error', 'Failed to save appointment: ' . $e->getMessage());
            return false;
        }
    }
    
}
?>
    
    