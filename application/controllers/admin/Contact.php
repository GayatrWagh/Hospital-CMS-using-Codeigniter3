<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
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
    //This method will show contact list page
    public function index()
    {
        $this->load->model('contact_model');
        $queryString=$this->input->get('q');
        $params['queryString']=$queryString;

        $contacts=$this->contact_model->getcontacts($params);
        $data['contacts']=$contacts;
        $data['queryString']=$queryString;                                                                                                                               

        $data['mainModule']='pages';
        $data['subModule']='viewContact';
        
        $this->load->view('admin/contact/list',$data);
    }
    
    //This method will show create contact page


public function edit($id)
{
    $this->load->model('contact_model');

    $data['mainModule']='pages';
    $data['subModule']='viewContact';
   $contact=$this->contact_model->getcontact($id);
   if(empty($contact))
   {
    $this->session->set_flashdata('error','contact Page Not Found');
    redirect(base_url().'admin/contact/index');

   }
   $this->load->helper('common_helper');


        // $config['upload_path']          = './public/uploads/contact/';
        // $config['allowed_types']        = 'gif|jpg|png';
        // $config['encrypt_name']         = true;
       
        // $this->load->library('upload', $config);
        $this->load->model('contact_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        $this->form_validation->set_rules('h_description', 'Heading Description', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('call_us', 'Call_Us', 'trim|required');

        
        

        // $this->form_validation->set_message('upload_file', 'Please upload a valid image file (gif, jpg, png).');

        // Set validation rules for image upload
        // if (!empty($_FILES['image']['name'])) 
        // {
        //     $this->form_validation->set_rules('image', 'Image', 'callback_validate_image');
        // }

        // Check if form is submitted and validate the form
        if($this->input->post() && $this->form_validation->run() == TRUE)
        {
            // if (!empty($_FILES['image']['name']))
            // {
                // if ($this->upload->do_upload('image'))
                // {
                    // File uploaded successfully.
                    //Resizing Part
                    // resizeImage($config['upload_path'].$this->upload->data('file_name'),$config['upload_path'].'thumb/'.$this->upload->data('file_name'),300,270);
                    // Proceed with contact creation
                    $formArray['title'] = $this->input->post('title');
                    $formArray['heading'] = $this->input->post('heading');
                    $formArray['h_description'] = $this->input->post('h_description');
                    $formArray['address'] = $this->input->post('address');
                    $formArray['email'] = $this->input->post('email');
                    $formArray['call_us'] = $this->input->post('call_us');


                    $this->contact_model->update($id,$formArray);
                    //
                    // if(file_exists('./public/uploads/contact/'.$contact['image']))
                    // {
                    //     unlink('./public/uploads/contact/'.$contact['image']);
                    // }

                    $this->session->set_flashdata('success', 'contact Updated successfully.');
                    redirect(base_url() . 'admin/contact/index');
                }
                // else
                // {
                //     // Error in image upload
                //     // $error = $this->upload->display_errors();
                //     // $data['errorImageUpload'] = $error;
                //     $data['contact']=$contact;
                //     $this->load->view('admin/contact/edit',$data);
                // }
            // }
      
            // else
            // {

            //     $formArray['title'] = $this->input->post('title');
            //         $formArray['heading'] = $this->input->post('heading');
            //         $formArray['h_description'] = $this->input->post('h_description');
                   
            //         $formArray['address'] = $this->input->post('address');
            //         $formArray['email'] = $this->input->post('email');
            //         $formArray['call_us'] = $this->input->post('call_us');


            //     // No image uploaded
            
            //     $this->contact_model->update($id,$formArray);
            //     $this->session->set_flashdata('success', 'contact Updated successfully.');
            //     redirect(base_url() . 'admin/contact/index');
            // }
        
        // }
        else
        {
            $data['contact']=$contact;
            $this->load->view('admin/contact/edit',$data);
        }
       
}
// public function validate_image($str)
// {
//     $allowed_types = ['image/gif', 'image/jpeg', 'image/png'];
//     $image_mime = $_FILES['image']['type'];

//     if (!in_array($image_mime, $allowed_types))
//     {
//         $this->form_validation->set_message('validate_image', 'Please upload a valid image file (gif, jpg, png).');
//         return FALSE;
//     }
// TRUE;
// }

}
?>