<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestEmail extends CI_Controller
{
    public function index()
    {
        $this->load->library('email');
        $config=array(
            'protocol'=>'smtp',
            'smtp_host'=>'ssl://smtp.gmail.com',
            'smtp_timeout'=>30,
            'smtp_port'=>465,
            'smtp_user'=>'waghgayatri42@gmail.com',
            'smtp_pass'=>'20272027',
            'charset'=>'utf-8',
            'mailtype'=>'html',
            'newline'=>'/r/n'
        );
        $this->email->initialize($config);
        $this->email->set_newline('/r/n');
        $this->email->set_crlf('/r/n');

// $this->email->from('waghgayatri42@gmail.com', 'Wagh Gayatri');
$this->email->to('surbhija2019@gmail.com');


$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

if($this->email->send())
{
    echo "mail send successfully";
}
else{
    echo "unable to send message";
}
    }
}