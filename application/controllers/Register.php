<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }


    public function index()
    {
        $data['title'] = "Register | LARACI";

        $this->form_validation->set_rules('register-fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('register-email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('register-password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('register/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'fullname' => htmlspecialchars($this->input->post('register-fullname'), true),
                'email' => htmlspecialchars($this->input->post('register-email'), true),
                'password' => password_hash($this->input->post('register-password'), PASSWORD_BCRYPT),
                'is_delete' => 0,
            ];

            $register = $this->crud->insertData($data, 'user');

            if ($register) {
                $this->session->set_flashdata('success', 'Registered Succesfully');
                redirect('login');
            } else {
                $this->session->set_flashdata('success', 'Register failed');
                redirect('register');
            }
        }
    }

    // ganti uri ini jika berhasil menambahkan satu admin supaya orang lain tidak mengetahuinya
    public function admin()
    {
        $data['title'] = "Register Admin | LARACI";

        $this->form_validation->set_rules('register-fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('register-email', 'Email', 'required|valid_email|is_unique[admin.email]');
        $this->form_validation->set_rules('register-password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('register/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'fullname' => htmlspecialchars($this->input->post('register-fullname'), true),
                'email' => htmlspecialchars($this->input->post('register-email'), true),
                'password' => password_hash($this->input->post('register-password'), PASSWORD_BCRYPT),
                'is_delete' => 0,
            ];

            $register = $this->crud->insertData($data, 'admin');

            if ($register) {
                $this->session->set_flashdata('success', 'Admin Registered Succesfully');

                // ganti redirect sesuai nama uri admin nya
                redirect('login/admin');
            } else {
                $this->session->set_flashdata('success', 'Admin Register failed');

                // ganti redirect sesuai nama uri admin nya
                redirect('register/admin');
            }
        }
    }
}
