<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
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
    //This method will show service list page
    public function index()
    {
        $this->load->model('Service_model');
        $queryString = $this->input->get('q');
        $params['queryString'] = $queryString;
    
        // Fetch services data
        $services = $this->Service_model->getServices($params);
        $data['services'] = $services;
    
        // Fetch service titles data
        $service_titles = $this->Service_model->getServiceTitles($params); // Corrected method name
        $data['service_titles'] = $service_titles;
    
        $data['queryString'] = $queryString;
    
        $data['mainModule'] = 'pages';
        $data['subModule'] = 'cService';
    
        $this->load->view('admin/service/list', $data);
    }
    

    // public function indexTitle()
    // {
    //     $this->load->model('Service_model');
    //     $queryString = $this->input->get('q');
    //     $params['queryString'] = $queryString;

    //     $service_title = $this->Service_model->getServiceTitles($params); // Corrected method name
    //     $data['service_title'] = $service_title;
    //     $data['queryString'] = $queryString;

    //     $data['mainModule'] = 'service';
    //     $data['subModule'] = 'viewService';

    //     $this->load->view('admin/service/list', $data);
    // }


    
    //This method will show create service page
    public function create()
    {
        $data['mainModule']='pages';
        $data['subModule']='cService';

        $this->load->helper('common_helper');

       

        $config['upload_path']          = './public/uploads/service/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('Service_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        // $this->form_validation->set_rules('title', 'Title', 'trim|required');
        // $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        // $this->form_validation->set_rules('h_description', 'Heading_Description', 'trim|required');
        // $this->form_validation->set_rules('image', 'Image', 'trim|required');
        $this->form_validation->set_rules('service_name', 'Service_Name', 'trim|required');
        $this->form_validation->set_rules('service_description', 'service_description', 'trim|required');
        

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
                    // Proceed with service creation
                    // $formArray['title'] = $this->input->post('title');
                    // $formArray['heading'] = $this->input->post('heading');
                    // $formArray['h_description'] = $this->input->post('h_description');
                    $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    $formArray['service_name'] = $this->input->post('service_name');
                    $formArray['service_description'] = $this->input->post('service_description');

                    $formArray['created_at'] = date('Y-m-d H:i:s');
                    $this->Service_model->create($formArray);
                    $this->session->set_flashdata('success', 'Service added successfully.');
                    redirect(base_url() . 'admin/service/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $this->load->view('admin/service/create', $data);
                }
            }
            else
            {
                // No image uploaded
                $formArray['service_name'] = $this->input->post('service_name');
                $formArray['service_description'] = $this->input->post('service_description');
                $formArray['created_at'] = date('Y-m-d H:i:s');
                $this->Service_model->create($formArray);
                $this->session->set_flashdata('success', 'Service added successfully.');
                redirect(base_url() . 'admin/service/index');
            }
        }
        else
        {
            // Form not submitted or validation failed
            $this->load->view('admin/service/create');
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


public function edit_title($id)
{
    $this->load->model('Service_model');

    $data['mainModule']='pages';
    $data['subModule']='cService';
   $service_title=$this->Service_model->getServiceTitle($id);
   if(empty($service_title))
   {
    $this->session->set_flashdata('error','Service Not Found');
    redirect(base_url().'admin/service/index');

   }
   $this->load->helper('common_helper');


        $config['upload_path']          = './public/uploads/service/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('Service_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        $this->form_validation->set_rules('h_description', 'Heading_Description', 'trim|required');
        // $this->form_validation->set_rules('image', 'Image', 'trim|required');
        // $this->form_validation->set_rules('service_name', 'Service_Name', 'trim|required');
        // $this->form_validation->set_rules('service_description', 'service_description', 'trim|required');
        
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
                    // Proceed with service creation
                    $formArray['title'] = $this->input->post('title');
                    $formArray['heading'] = $this->input->post('heading');
                    $formArray['h_description'] = $this->input->post('h_description');
                    // $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    // $formArray['service_name'] = $this->input->post('service_name');
                    // $formArray['service_description'] = $this->input->post('service_description');
                    // $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->Service_model->updateTitle($id,$formArray);
                    //
                    if(file_exists('./public/uploads/service/'.$service_title['image']))
                    {
                        unlink('./public/uploads/service/'.$service_title['image']);
                    }


                    $this->session->set_flashdata('success', 'Service Updated successfully.');
                    redirect(base_url() . 'admin/service/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $data['service_title']=$service_title;
                    $this->load->view('admin/service/edit_title',$data);
                }
            }
      
            else
            {
                // No image uploaded
                $formArray['title'] = $this->input->post('title');
                $formArray['heading'] = $this->input->post('heading');
                $formArray['h_description'] = $this->input->post('h_description');
            
                // $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Service_model->updateTitle($id,$formArray);
                $this->session->set_flashdata('success', 'Service Updated successfully.');
                redirect(base_url() . 'admin/service/index');
            }
        
        }
        else
        {
            $data['service_title']=$service_title;
            $this->load->view('admin/service/edit_title',$data);
        }
}
public function edit_service($id)
{
    $this->load->model('Service_model');

    $data['mainModule']='pages';
    $data['subModule']='cService';
   $service=$this->Service_model->getService($id);
   if(empty($service))
   {
    $this->session->set_flashdata('error','Service Not Found');
    redirect(base_url().'admin/service/index');

   }
   $this->load->helper('common_helper');


        $config['upload_path']          = './public/uploads/service/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('Service_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        // $this->form_validation->set_rules('title', 'Title', 'trim|required');
        // $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        // $this->form_validation->set_rules('h_description', 'Heading_Description', 'trim|required');
        // $this->form_validation->set_rules('image', 'Image', 'trim|required');
        $this->form_validation->set_rules('service_name', 'Service_Name', 'trim|required');
        $this->form_validation->set_rules('service_description', 'service_description', 'trim|required');
        
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
                    // Proceed with service creation
                    // $formArray['title'] = $this->input->post('title');
                    // $formArray['heading'] = $this->input->post('heading');
                    // $formArray['h_description'] = $this->input->post('h_description');
                    $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    $formArray['service_name'] = $this->input->post('service_name');
                    $formArray['service_description'] = $this->input->post('service_description');
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->Service_model->update($id,$formArray);
                    //
                    if(file_exists('./public/uploads/service/'.$service['image']))
                    {
                        unlink('./public/uploads/service/'.$service['image']);
                    }


                    $this->session->set_flashdata('success', 'Service Updated successfully.');
                    redirect(base_url() . 'admin/service/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $data['service']=$service;
                    $this->load->view('admin/service/edit_service',$data);
                }
            }
      
            else
            {
                // No image uploaded
                $formArray['service_name'] = $this->input->post('service_name');
                $formArray['service_description'] = $this->input->post('service_description');
            
                $formArray['updated_at'] = date('Y-m-d H:i:s');
                $this->Service_model->update($id,$formArray);
                $this->session->set_flashdata('success', 'Service Updated successfully.');
                redirect(base_url() . 'admin/service/index');
            }
        
        }
        else
        {
            $data['service']=$service;
            $this->load->view('admin/service/edit_service',$data);
        }
}
public function delete($id)
{
    $this->load->model('Service_model');
    $service=$this->Service_model->getService($id);
    if(empty($service))
    {
     $this->session->set_flashdata('error','Service Not Found');
     redirect(base_url().'admin/service/index');
    }
    if(file_exists('./public/uploads/service/'.$service['image']))
    {
        unlink('./public/uploads/service/'.$service['image']);
    }
    $this->Service_model->delete($id);
    $this->session->set_flashdata('success','Service deleted successfully');
    redirect(base_url().'admin/service/index');

}
}
?>