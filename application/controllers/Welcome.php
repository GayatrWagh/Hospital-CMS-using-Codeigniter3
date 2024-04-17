<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{             
		$this->load->model('Doctor_model');
	
		$param['offset']=4;
		$param['limit']=0;
		
		$doctors=$this->Doctor_model->getDoctorsFront($param);
		$data['doctors']=$doctors;

		$this->load->view('index',$data);                                                                                                                                               
	}
	public function about()
	{
		$this->load->model('About_model');
		$abouts=$this->About_model->getAboutsFront();
		$data=[];
		$data['abouts']=$abouts;
		$this->load->view('about',$data);
	}
	
	public function services()
{
    $this->load->model('Service_model');
    $params = []; // Define params array
    $service_titles = $this->Service_model->getServiceTitles($params); // Corrected method name
    $data['service_titles'] = $service_titles;

    $services = $this->Service_model->getServicesFront($params); // Call once with correct method
    $data['services'] = $services;
    $this->load->view('services', $data);
}

	
	
	public function contact()
	{

		$this->load->model('Contact_model');
		$contacts=$this->Contact_model->getContactsFront();
		$data=[];
		$data['contacts']=$contacts;
		$this->load->view('contact',$data);
	}
	public function department()
	{
        $this->load->model('Department_model');
		$departments=$this->Department_model->getDepartmentsFront();
		$data=[];
		$data['departments']=$departments;
		// print_r($departments);
		$this->load->view('department',$data);                                                                                                                                                                           
	}
	public function doctor()
	{
		$this->load->model('Doctor_model');
	
		$doctors=$this->Doctor_model->getDoctorsFront();
		$data=[];
		$data['doctors']=$doctors;
		$this->load->view('doctor',$data);
	}
	// public function detail($id)
	// {
	// 	echo

	// }
}
