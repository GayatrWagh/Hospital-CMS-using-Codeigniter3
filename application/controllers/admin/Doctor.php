<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $admin=$this->session->userdata('admin');
        if(empty($admin))
        {
            $this->session->set_flashdata('msg','Your Session has been expired');
            redirect(base_url().'admin/login/index');
        }
    }
    public function index($page = 1)
{ 
    $perpage = 5;
  
    $param['per_page'] = $perpage; // Corrected parameter name
    $param['offset'] = ($page - 1) * $perpage; // Corrected offset calculation
    $param['q'] = $this->input->get('q');

    $this->load->model('Doctor_model');
    $this->load->library('pagination');
    $config['base_url'] = base_url('admin/doctor/index');
    $config['total_rows'] = $this->Doctor_model->getDoctorsCount($param);
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
   
    $doctors = $this->Doctor_model->getDoctors($param);
   
    $data['q'] = $this->input->get('q');
    $data['doctors'] = $doctors;
    $data['pagination_links'] = $pagination_links;
    
    $data['mainModule'] = 'doctor';
    $data['subModule'] = 'viewDoctor';


    $this->load->view("admin/doctor/list", $data);
}

    public function create()
{
    $this->load->model('Department_model');
    $this->load->model('Doctor_model');

    $data['mainModule'] = 'doctor';
    $data['subModule'] = 'createDoctor';


    $departments = $this->Department_model->getDepartments();
    $data['departments'] = $departments;

    // File upload settings
    $config['upload_path'] = './public/uploads/doctors/';
    $config['allowed_types'] = 'gif|png|jpg';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
    $this->form_validation->set_rules('department_id', 'Department', 'trim|required'); 
    $this->form_validation->set_rules('name', 'Name', 'trim|required');      
    $this->form_validation->set_rules('designation', 'Designation', 'trim|required');                                                                                                                                                                                                                                                                        
    
    if ($this->form_validation->run() == true) {
        // Form validated successfully
        $formArray = array(
            'name' => $this->input->post('name'),
            'department' => $this->input->post('department_id'),
            'description' => $this->input->post('description'),
            'designation' => $this->input->post('designation'),
            'status' => $this->input->post('status'),
            'created_at' => date('Y-m-d H:i:s')
        );

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                // Image successfully uploaded
                $upload_data = $this->upload->data();
                $formArray['image'] = $upload_data['file_name'];
            } else {
                // Image upload failed
                $errors = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
                $data['imageError'] = $errors;
                $this->load->view("admin/doctor/create", $data);
                return; // Stop further execution
            }
        }

        // Add doctor to the database
        $this->Doctor_model->addDoctor($formArray);
        $this->session->set_flashdata('success','Doctor Added successfully');
        redirect(base_url() . 'admin/doctor/index');
    } else {
        // Form not validated
        $this->load->view("admin/doctor/create", $data);
    }
}

    public function edit($id)
    {

        $this->load->library('form_validation');
        $this->load->model('Doctor_model');
        $this->load->model('Department_model');
        $this->load->helper('common_helper');

        $data['mainModule']='doctor';
        $data['subModule']='';

        $doctor=$this->Doctor_model->getDoctor($id);
        // print_r($doctor);
        if(empty($doctor))
        {
            $this->session->set_flashdata('error','Doctor Not Found');
            redirect(base_url('admin/doctor/index'));                                                                            
        }
        $departments = $this->Department_model->getDepartments();
        $data['departments'] = $departments;
        $data['doctor']=$doctor;

// File upload settings
    $config['upload_path'] = './public/uploads/doctors/';
    $config['allowed_types'] = 'gif|png|jpg';
    $config['encrypt_name'] = true;

    $this->load->library('upload', $config);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
    $this->form_validation->set_rules('department_id', 'Department', 'trim|required'); 
    $this->form_validation->set_rules('name', 'Name', 'trim|required');      
    $this->form_validation->set_rules('designation', 'Designation', 'trim|required');                                                                                                                                                                                                                                                                        
    
    if ($this->form_validation->run() == true) {
        // Form validated successfully
        $formArray = array(
            'name' => $this->input->post('name'),
            'department' => $this->input->post('department_id'),
            'description' => $this->input->post('description'),
            'designation' => $this->input->post('designation'),
            'status' => $this->input->post('status'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        // Handle image upload
        if (!empty($_FILES['image']['name'])) {
            if ($this->upload->do_upload('image')) {
                // Image successfully uploaded
                $upload_data = $this->upload->data();

                $path='./public/uploads/doctors/'.$doctor['image'];
                if($doctor['image']!="" && file_exists($path)) 
                {
                    unlink($path);
                }                                                                                                                                                                                                      


                $formArray['image'] = $upload_data['file_name'];
            } else {
                // Image upload failed
                $errors = $this->upload->display_errors('<p class="invalid-feedback">', '</p>');
                $data['imageError'] = $errors;
                $this->load->view('admin/doctor/edit',$data);
                return; // Stop further execution
            }
        }

        // Add doctor to the database
        $this->Doctor_model->updateDoctor($id,$formArray);
        $this->session->set_flashdata('success','Doctor Updated Successfully');
        redirect(base_url() . 'admin/doctor/index');
    } else {
        // Form not validated
        $this->load->view('admin/doctor/edit',$data);
    }                                                                                                                                                         
    }


    public function delete($id)
    {
        $this->load->model('Doctor_model');

        $doctor=$this->Doctor_model->getDoctor($id);
        if(empty($doctor))
        {
            $this->session->set_flashdata('error','Doctor Not Found');
            redirect(base_url('admin/doctor/index'));                                                                            
        }

        $path='./public/uploads/doctors/'.$doctor['image'];
                if($doctor['image']!="" && file_exists($path)) 
                {
                    unlink($path);
                }  

        $this->Doctor_model->deleteDoctor($id);


        $this->session->set_flashdata('success','Doctor Deleted Successfully');
        redirect(base_url() . 'admin/doctor/index');


    }

}
?>