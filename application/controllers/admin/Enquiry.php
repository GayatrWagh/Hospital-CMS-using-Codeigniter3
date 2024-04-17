<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enquiry extends CI_Controller
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
    //This method will show enquiry list page

    public function index($page = 1)
    {
        $perpage = 5;
        $offset = ($page - 1) * $perpage;
    
        $param['limit'] = $perpage;
        $param['offset'] = $offset;
        $param['q'] = $this->input->get('q');
    
        $this->load->model('Enquiries_model');
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/enquiry/index');
        $config['total_rows'] = $this->Enquiries_model->getEnquiriesCount($param);
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
    
        $data['enquiries'] = $this->Enquiries_model->getEnquiries($param);
        $data['queryString'] = $param['q'];
        $data['mainModule'] = 'enquiry';
        $data['subModule'] = 'viewEnquiry';
    
        $this->load->view('admin/enquiry/list', $data);
    }
    //This method will show create enquiry page


public function edit($id)
{
    $this->load->model('Enquiries_model');

    $data['mainModule']='enquiry';
    $data['subModule']='viewEnquiry';
   $enquiry=$this->Enquiries_model->getEnquiry($id);
   if(empty($enquiry))
   {
    $this->session->set_flashdata('error','Enquiry Page Not Found');
    redirect(base_url().'admin/enquiry/index');

   }
   $this->load->helper('common_helper');


        // $config['upload_path']          = './public/uploads/enquiry/';
        // $config['allowed_types']        = 'gif|jpg|png';
        // $config['encrypt_name']         = true;
       
        // $this->load->library('upload', $config);
        $this->load->model('Enquiries_model');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="invalid-feedback">', '</p>');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        // $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
       
        
        

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
                    // Proceed with enquiry creation
                    $formArray['name'] = $this->input->post('name');
                    $formArray['email'] = $this->input->post('email');
                    // $formArray['phone'] = $this->input->post('phone');
                    $formArray['subject'] = $this->input->post('subject');
                    $formArray['message'] = $this->input->post('message');
                  


                    $this->Enquiries_model->update($id,$formArray);
                    //
                    // if(file_exists('./public/uploads/enquiry/'.$enquiry['image']))
                    // {
                    //     unlink('./public/uploads/enquiry/'.$enquiry['image']);
                    // }

                    $this->session->set_flashdata('success', 'Enquiry Updated successfully.');
                    redirect(base_url() . 'admin/enquiry/index');
                }
                // else
                // {
                //     // Error in image upload
                //     // $error = $this->upload->display_errors();
                //     // $data['errorImageUpload'] = $error;
                //     $data['enquiry']=$enquiry;
                //     $this->load->view('admin/enquiry/edit',$data);
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
            
            //     $this->Enquiries_model->update($id,$formArray);
            //     $this->session->set_flashdata('success', 'Enquiry Updated successfully.');
            //     redirect(base_url() . 'admin/enquiry/index');
            // }
        
        // }
        else
        {
            $data['enquiry']=$enquiry;
            $this->load->view('admin/enquiry/edit',$data);
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
public function updateStatus() {
    $this->load->model('Enquiries_model');

    $enquiry_id = $this->input->post('enquiry_id');
    $new_status = $this->input->post('new_status');

    // Update enquiry status in the database
    $this->Enquiries_model->updateStatus($enquiry_id, $new_status);

    // Get enquiry details
    $enquiry = $this->Enquiries_model->getEnquiry($enquiry_id);

    // Send email notification to the user
    if ($new_status == 'Approved') {
        $this->sendNotificationEmail($enquiry['email'], 'Your enquiry is Approved');
    } elseif ($new_status == 'Cancelled') {
        $this->sendNotificationEmail($enquiry['email'], 'Your enquiry is Cancelled');
    }

    // Return success response
    echo json_encode(array('success' => true));
}


}
?>