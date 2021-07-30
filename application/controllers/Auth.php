<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function registration()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|alpha_numeric');
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|alpha_numeric|matches[password]', [
            'matches' => 'Password Tidak Sama',
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', 'Oops Terjadi Kesalahan');
            $data['title'] = "Registrasi";
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'fullname' => htmlspecialchars($this->input->post('fullname', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'phone' => htmlspecialchars($this->input->post('phone', true)),
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),
                'role' => 'admin',
                'foto' => 'default.jpg',
                'dateCreated' => time()
            ];
            $this->db->insert('user', $data);

            $this->session->set_flashdata('success', 'Akun anda berhasil dibuat. Silahkan login');
            redirect('auth');
        }
    }
}
