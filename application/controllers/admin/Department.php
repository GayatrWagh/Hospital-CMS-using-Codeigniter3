<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller
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
    //This method will show department list page
    public function index()
    {
        $this->load->model('Department_model');
        $queryString=$this->input->get('q');
        $params['queryString']=$queryString;

        $departments=$this->Department_model->getDepartments($params);
        $data['departments']=$departments;
        $data['queryString']=$queryString;                                                                                                                               

        $data['mainModule']='department';
        $data['subModule']='viewDepartment';
        
        $this->load->view('admin/department/list',$data);
    }
    
    //This method will show create department page
    public function create()
    {
        $data['mainModule']='department';
        $data['subModule']='cDepartment';

        $this->load->helper('common_helper');

       

        $config['upload_path']          = './public/uploads/department/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('Department_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
         $this->form_validation->set_rules('description', 'Description', 'trim|required');

        // Custom error message for image upload
        $this->form_validation->set_message('upload_file', 'Please upload a valid image file (gif, jpg, png).');

        // Set validation rules for image upload
        if (!empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        }

        // Check if form is submitted and validate the form
        if ($this->input->post() && $this->form_validation->run() == TRUE)
        {
            // If image is uploaded successfully
            if (!empty($_FILES['image']['name']))
            {
                if ($this->upload->do_upload('image'))
                {
                    // File uploaded successfully.
                    //Resizing Part
                    // resizeImage($config['upload_path'].$this->upload->data('file_name'),$config['upload_path'].'thumb/'.$this->upload->data('file_name'),300,270);
                    // Proceed with department creation
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                     $formArray['description'] = $this->input->post('description');
                    $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->Department_model->create($formArray);
                    $this->session->set_flashdata('success', 'Department added successfully.');
                    redirect(base_url() . 'admin/department/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $this->load->view('admin/department/create', $data);
                }
            }
            else
            {
                // No image uploaded
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['description'] = $this->input->post('description');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->Department_model->create($formArray);
                $this->session->set_flashdata('success', 'Department added successfully.');
                redirect(base_url() . 'admin/department/index');
            }
        }
        else
        {
            // Form not submitted or validation failed
            $this->load->view('admin/department/create');
        }
    }

    // Callback function to validate image upload
    

public function validate_image($str)
{
    $allowed_types = ['image/gif', 'image/jpeg', 'image/png'];
    $image_mime = $_FILES['image']['type'];

    if (!in_array($image_mime, $allowed_types))
    {
        $this->form_validation->set_message('validate_image', 'Please upload a valid image file (gif, jpg, png).');
        return FALSE;
    }
TRUE;
}

public function edit($id)
{
    $this->load->model('Department_model');

    $data['mainModule']='department';
    $data['subModule']='';
   $department=$this->Department_model->getDepartment($id);
   if(empty($department))
   {
    $this->session->set_flashdata('error','Department Not Found');
    redirect(base_url().'admin/department/index');

   }
   $this->load->helper('common_helper');


        $config['upload_path']          = './public/uploads/department/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('Department_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $this->form_validation->set_message('upload_file', 'Please upload a valid image file (gif, jpg, png).');

        // Set validation rules for image upload
        if (!empty($_FILES['image']['name'])) 
        {
            $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        }

        // Check if form is submitted and validate the form
        if($this->input->post() && $this->form_validation->run() == TRUE)
        {
            if (!empty($_FILES['image']['name']))
            {
                if ($this->upload->do_upload('image'))
                {
                    // File uploaded successfully.
                    //Resizing Part
                    // resizeImage($config['upload_path'].$this->upload->data('file_name'),$config['upload_path'].'thumb/'.$this->upload->data('file_name'),300,270);
                    // Proceed with department creation
                    $formArray['name'] = $this->input->post('name');
                    $formArray['status'] = $this->input->post('status');
                    $formArray['description'] = $this->input->post('description');
                    $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->Department_model->update($id,$formArray);
                    //
                    if(file_exists('./public/uploads/department/'.$department['image']))
                    {
                        unlink('./public/uploads/department/'.$department['image']);
                    }


                    $this->session->set_flashdata('success', 'Department Updated successfully.');
                    redirect(base_url() . 'admin/department/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $data['department']=$department;
                    $this->load->view('admin/department/edit',$data);
                }
            }
      
            else
            {
                // No image uploaded
                $formArray['name'] = $this->input->post('name');
                $formArray['status'] = $this->input->post('status');
                $formArray['description'] = $this->input->post('description');
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Department_model->update($id,$formArray);
                $this->session->set_flashdata('success', 'Department Updated successfully.');
                redirect(base_url() . 'admin/department/index');
            }
        
        }
        else
        {
            $data['department']=$department;
            $this->load->view('admin/department/edit',$data);
        }
}
public function delete($id)
{
    $this->load->model('Department_model');
    $department=$this->Department_model->getDepartment($id);
    if(empty($department))
    {
     $this->session->set_flashdata('error','Department Not Found');
     redirect(base_url().'admin/department/index');
    }
    if(file_exists('./public/uploads/department/'.$department['image']))
    {
        unlink('./public/uploads/department/'.$department['image']);
    }
    $this->Department_model->delete($id);
    $this->session->set_flashdata('success','Department deleted successfully');
    redirect(base_url().'admin/department/index');

}

//
// public function getDepartments() {
//     $this->load->model('Department_model');
//     $departments = $this->Department_model->getDepartmentsFront(); // Assuming this method fetches all departments
//     echo json_encode($departments);
// }



}
?>