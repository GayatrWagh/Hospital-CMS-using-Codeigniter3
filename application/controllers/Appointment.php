<?php
class Appointment extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Appointment_model');
      //  $this->load->model('Department_model');
    }

    public function index() {
        // Load departments from the model
        $this->load->model('Department_model');
        //$departments = $this->Department_model->getAllDepartments();
        $data['departments'] = $this->Department_model->getDepartments();
        // Pass departments to the view
        //$data['departments'] = $departments;
    
        // Load your appointment view here
        $this->load->view('appointment_view', $data);
    
    }
    public function getDoctorsByDepartment() {
        // Get the selected department_id from the POST data
        $department_id = $this->input->post('department_id');

        // Check if department_id is provided
        if (!empty($department_id)) {
            // Call the Department_model's method to get doctors by department
            $doctors = $this->Department_model->getDoctorsByDepartment($department_id);

            // Encode the result as JSON and echo it
            echo json_encode($doctors);
        } else {
            // If department_id is not provided, return an empty array
            echo json_encode([]);
        }
    }
    public function getDoctors() {
        // Load the Department_model if not already loaded
        $this->load->model('Department_model');

        // Get the selected department_id from the POST data
        $department_id = $this->input->post('department_id');

        // Check if department_id is provided
        if (!empty($department_id)) {
            // Call the Department_model's method to get doctors by department
            $doctors = $this->Department_model->getDoctorsByDepartment($department_id);

            // Encode the result as JSON and echo it
            echo json_encode($doctors);
        } else {
            // If department_id is not provided, return an empty array
            echo json_encode([]);
        }
    }

   

    public function store() {
        $this->load->model('Department_model');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('date', 'Appointment Date', 'required');
        // $this->form_validation->set_rules('department', 'Department', 'required');
        // $this->form_validation->set_rules('doctor', 'Doctor', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, return error response
            $response['status'] = 'error';
            $response['message'] = validation_errors();
        } else {
            // Validation passed, store appointment data in database
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'app_date' => $this->input->post('date'),
                'department' => $this->input->post('department'),
                'doctor' => $this->input->post('doctor'),
                'message' => $this->input->post('message')
            );
    
            $appointment_id = $this->Appointment_model->save_appointment($data);
            if ($appointment_id) {
                // Appointment saved successfully
                $response['status'] = 'success';
                $response['message'] = 'Appointment saved successfully!';
                // Integrate SweetAlert here
                $response['sweet_alert'] = true;
            } else {
                // Appointment failed to save
                $response['status'] = 'error';
                $response['message'] = 'Failed to save appointment!';
            }
        }
    
        // Echo JSON response
        echo json_encode($response);
    }
    public function fetchDepartments() {
        $data['departments'] = $this->db->get('departments')->result();
        // Load view to display departments
        // $this->load->view('departments_view', $data);
    }
    
    // This method fetches doctors based on selected department
    public function fetchDoctors() {
        $department_id = $this->input->post('department');
        $data['doctors'] = $this->db->get_where('doctors', array('department' => $department_id))->result();
        // Load view to display doctors
        // $this->load->view('doctors_view', $data);
    }
    

}
?>
