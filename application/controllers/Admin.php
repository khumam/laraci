<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role') == 'user' || $this->session->userdata('role') == '') {
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = "ADMIN LARACI";
        $this->load->view('template/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }
}
