<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

	public function index()
	{
		$data = array();
		$data['active'] = 'login';
		$this->load->view('index', $data);
	}
	function login()
	{
		$data = array();
		if(isset($_POST['loginbttn']))
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) 
			{
				$data['reset'] = FALSE;
			}
			else
			{
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));
				if($this->user_model->login($username, $password))
				{
					redirect(base_url().'users');
				}
				else
				{
					$data['error'] = 'Username / password salah. Silahkan ulangi kembali !';
				}

			}
		}
		$data['active'] = 'login';
		$this->load->view('index', $data);
	}
	function register()
	{
		$data = array();
		if(isset($_POST['registerbttn']))
		{
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_exists');
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[6]|max_length[20]|callback_username_exists');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('confirmpassword', 'Confirm password', 'trim|required|xss_clean|matches[password]');
			$this->form_validation->set_rules('enterCode', 'Security Code', 'callback_check_captcha');
			$this->form_validation->set_error_delimiters('<span class="fielderror">', '</span>');
		
			if($this->form_validation->run() == FALSE) 
			{
				$data['reset'] = FALSE;
			}
			else
			{
				$userdetails = array('firstname' => $this->input->post('firstname'),
									 'lastname'  => $this->input->post('lastname'),
									 'email'     => $this->input->post('email'),
									 'username'  => $this->input->post('username'),
									 'password'  => sha1($this->input->post('password'))
					);
				if($this->user_model->insert('users', $userdetails))
				{
					$data['success'] = 'Pendaftaran akun berhasil, silahkan login !';
					redirect('/');
				}
				else
				{
					$data['error'] = 'Terjadi Error Silahkan Ulangi !';
				}

			}
		}
		$data['active'] = 'register';
		$this->load->view('register', $data);
	}

	function email_exists($email)
	{
		if($this->user_model->email_exists($email))
		{
		$this->form_validation->set_message('email_exists', 'Email already exists. Select another email');
        return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function username_exists($username)
	{
		if($this->user_model->username_exists($username))
		{
		$this->form_validation->set_message('username_exists', 'Username already exists. Select another username');
        return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function logout()
    {
        $this->session->unset_userdata('userdetails');
        $this->index();
    }



}
