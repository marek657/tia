<?php


class UserController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
		$this->load->helper(array('security'));
	}

	function index()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data2['name'] = $this->session->userdata('name');
			$data['data'] = $data2;
		}

		$data['main_content'] = 'welcome';
		$this->load->view('template', $data);

	}

	function setlogin()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);
		} else {
			$data['logged_in'] = true;
			$data['function'] = $this->session->userdata['function'];
			$data['main_content'] = 'welcome';
			$this->load->view('template', $data);
		}

	}

	function registration()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'required|xss_clean|trim|htmlspecialchars');
		$this->form_validation->set_rules('lastname', 'Lastname','required|xss_clean|trim|htmlspecialchars');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|htmlspecialchars|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|htmlspecialchars|min_length[4]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|xss_clean|htmlspecialchars|matches[password]');
		$this->form_validation->set_message('check_captcha', 'text dont match captcha');

		if (($this->form_validation->run()))
		{
			$query = $this->usermodel->getByEmail($_POST['email']);
			if ( $query == false )
			{
				$data = array(
					'name' => $_POST['name'],
					'lastname' => $_POST['lastname'],
					'email' => $_POST['email'],
					'password' => sha1($_POST['password']),
				 );

				$query = $this->usermodel->addUser($data);
				if ( $query == false )
				{
					print "error_something_wrong";
					$data['logged_in'] = false;
					$data['main_content'] = 'login';
					$this->load->view('template', $data);
				}
				else
				{
					print "msg_signup_succasful";
					$data['logged_in'] = false;
					$data['main_content'] = 'welcome';
					$this->load->view('template', $data);
				}
			}
			else
			{
				print "error_email";
				$data['logged_in'] = false;
				$data['main_content'] = 'login';
				$this->load->view('template', $data);
			}
		}
		else
		{
			print "error_wrong_data";
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);
		}
	}

	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'email', 'required|trim|xss_clean|htmlspecialchars');
		$this->form_validation->set_rules('password', 'password', 'required|trim|xss_clean|htmlspecialchars');

		if ($this->form_validation->run())
		{
			$query = $this->usermodel->checkPassword(sha1($_POST['password']), $_POST['email']);

			if ($query)
			{
					$data = $this->usermodel->getByEmail($_POST['email']);
					$data['logged_in'] = true;
					$data['function'] = $data['role_id'];
					$this->session->set_userdata($data);
					$data2['name'] = $this->session->userdata('name');
					$data['data'] = $data2;
					$data['main_content'] = 'welcome';
					$this->load->view('template', $data);
			}
			else
			{
				print "error_incorrect_login_query";
				$data['logged_in'] = false;
				$data['main_content'] = 'login';
				$this->load->view('template', $data);
			}
		} else {
			print "error_incorrect_login_validation_error";
			$data['logged_in'] = false;
			$data['main_content'] = 'login';
			$this->load->view('template', $data);
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		$data['logged_in'] = false;
		$data['message'] = $this->lang->line("msg_logout_succasful");
		$data['main_content'] = 'welcome';
		$this->load->view('template', $data);
	}
}
