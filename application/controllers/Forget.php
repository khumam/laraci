<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forget extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Reset Password | LARACI";
        $this->form_validation->set_rules('forget-email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('forget/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $func = [
                'identifier' => [
                    'email' => htmlspecialchars($this->input->post('forget-email'), true),
                ]
            ];

            $checkEmail = $this->crud->getData($func, 'user', true);

            if ($checkEmail) {
                $sendEmail = $this->_sendEmail($this->input->post('forget-email'));
                if ($sendEmail) {
                    $this->session->set_flashdata('success', 'Password reset has been sent to your email');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('danger', 'Error sending Password reset to your email');
                    redirect('forget');
                }
            } else {
                $this->session->set_flashdata('danger', 'Email you filled is wrong or not found');
                redirect('forget');
            }
        }
    }

    // Isi dengan akun email Anda
    private function _sendEMail($email)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'your@gmail.com',
            'smtp_pass' => 'youremailpassword',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);

        $this->email->from('your@rmail.com', 'yourName');
        $this->email->to($email);
        $this->email->subject('Your Email Subject');
        $this->email->message('Your Email Message sent to user');
        $send = $this->email->send();
        return $send ? true : false;
    }
}
