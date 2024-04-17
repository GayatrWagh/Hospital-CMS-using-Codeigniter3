<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller
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
    //This method will show about list page
    public function index()
    {
        $this->load->model('About_model');
        $queryString=$this->input->get('q');
        $params['queryString']=$queryString;

        $abouts=$this->About_model->getAbouts($params);
        $data['abouts']=$abouts;
        $data['queryString']=$queryString;                                                                                                                               

        $data['mainModule']='pages';
        $data['subModule']='viewAbout';
        
        $this->load->view('admin/about/list',$data);
    }
    
    //This method will show create about page


public function edit($id)
{
    $this->load->model('About_model');

    $data['mainModule']='pages';
    $data['subModule']='';
   $about=$this->About_model->getAbout($id);
   if(empty($about))
   {
    $this->session->set_flashdata('error','About Page Not Found');
    redirect(base_url().'admin/about/index');

   }
   $this->load->helper('common_helper');


        $config['upload_path']          = './public/uploads/about/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['encrypt_name']         = true;
       
        $this->load->library('upload', $config);
        $this->load->model('About_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        $this->form_validation->set_rules('h_description', 'Heading Description', 'trim|required');
        $this->form_validation->set_rules('small_description', 'Small Description', 'trim|required');
        $this->form_validation->set_rules('large_description', 'Large Description', 'trim|required');
        
        

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
                    // Proceed with about creation
                    $formArray['title'] = $this->input->post('title');
                    $formArray['heading'] = $this->input->post('heading');
                    $formArray['h_description'] = $this->input->post('h_description');
                    $formArray['image'] = $this->upload->data('file_name'); // Save uploaded image filename
                    $formArray['small_description'] = $this->input->post('small_description');
                    $formArray['large_description'] = $this->input->post('large_description');
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                    $this->About_model->update($id,$formArray);
                    //
                    if(file_exists('./public/uploads/about/'.$about['image']))
                    {
                        unlink('./public/uploads/about/'.$about['image']);
                    }


                    $this->session->set_flashdata('success', 'About Updated successfully.');
                    redirect(base_url() . 'admin/about/index');
                }
                else
                {
                    // Error in image upload
                    $error = $this->upload->display_errors();
                    $data['errorImageUpload'] = $error;
                    $data['about']=$about;
                    $this->load->view('admin/about/edit',$data);
                }
            }
      
            else
            {

                $formArray['title'] = $this->input->post('title');
                    $formArray['heading'] = $this->input->post('heading');
                    $formArray['h_description'] = $this->input->post('h_description');
                   
                    $formArray['small_description'] = $this->input->post('small_description');
                    $formArray['large_description'] = $this->input->post('large_description');
                    $formArray['updated_at'] = date('Y-m-d H:i:s');

                // No image uploaded
            
                $this->About_model->update($id,$formArray);
                $this->session->set_flashdata('success', 'About Updated successfully.');
                redirect(base_url() . 'admin/about/index');
            }
        
        }
        else
        {
            $data['about']=$about;
            $this->load->view('admin/about/edit',$data);
        }
       
}
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

}
?>