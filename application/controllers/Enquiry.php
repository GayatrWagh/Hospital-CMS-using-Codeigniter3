<?php
class Enquiry extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Enquiry_model');
    }

    public function index() {
        // Load your enquiry view here
        $this->load->view('enquiry');
    }

    public function store() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('subject', 'Subject', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
      
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return error response
            $response['status'] = 'error';
            $response['message'] = validation_errors();
        } else {
            // Validation passed, store enquiry data in database
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                // 'phone' => $this->input->post('phone'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            );
    
            $enquiry_id = $this->Enquiry_model->save_enquiry($data);
            if ($enquiry_id) {
                // Enquiry saved successfully
                $response['status'] = 'success';
                $response['message'] = 'Enquiry saved successfully!';
            } else {
                // Enquiry failed to save
                $response['status'] = 'error';
                $response['message'] = 'Failed to save enquiry!';
            }
        }
    
        // Echo JSON response
        echo json_encode($response);
    }
}
?>
