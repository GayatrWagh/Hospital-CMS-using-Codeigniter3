<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller
{
    public function __construct()
    {
        
        parent::__construct();
        $admin=$this->session->userdata('admin');
        if(empty($admin))
        {
            $this->session->set_flashdata('msg','Your Session has been expired');
            redirect(base_url().'admin/login/index');
            $this->load->model('Appointments_model');
            // $this->load->library('email');


        }
    }
    //This method will show appointment list page
    public function index($page = 1)
    {
        // $this->load->library('email');
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
    
        $param['limit'] = $perpage;
        $param['offset'] = $offset;
        $param['q'] = $this->input->get('q');
    
        $this->load->model('Appointments_model');
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/appointment/index');
        $config['total_rows'] = $this->Appointments_model->getAppointmentsCount($param);
        $config['per_page'] = $perpage;
        $config['use_page_numbers'] = true;
    
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
    
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="disabled page-item"><li class="active page-item"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">'; 
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
    
        $this->pagination->initialize($config);
    $pagination_links = $this->pagination->create_links();
    $data['pagination_links'] = $pagination_links;


        $this->load->model('Appointments_model');
        $queryString=$this->input->get('q');
        $params['queryString']=$queryString;

        $data['appointments'] = $this->Appointments_model->getAppointments($param);
    $data['queryString'] = $param['q'];
    $data['mainModule'] = 'form';
    $data['subModule'] = 'viewAppointment';
    

    $this->load->view('admin/appointment/list', $data);
}
   
   
    //This method will show create appointment page


    public function updateStatus() {
        $appointment_id = $this->input->post('appointment_id'); // Corrected from 'id'
        $new_status = $this->input->post('new_status');
    
        $success = $this->Appointments_model->updateStatus($appointment_id, $new_status);
    
        if ($success) {
            $appointment = $this->Appointments_model->getAppointment($appointment_id);
    
            if ($new_status == 'Approved') {
                $this->send_email_to_user($appointment['email'], 'Appointment Approved');
            } elseif ($new_status == 'Cancelled') {
                $this->send_email_to_user($appointment['email'], 'Appointment Cancelled');
            }
    
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to update status.'));
        }
    }
    public function send_email_to_user($email, $status) {
        $this->email->from('waghgayatri42@gmail.com', 'Gayatri wagh');
        $this->email->to($email);

        $this->email->subject($status);
        $this->email->message("Your appointment has been $status. Thank you.");

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
?>