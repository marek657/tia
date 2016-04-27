<?php


class NoteController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
    $this->load->model('notemodel');
		$this->load->helper(array('security'));
	}

	function index()
	{
		if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
			$data['logged_in'] = false;
		} else {
			$data['logged_in'] = $this->session->userdata['logged_in'];
			$data['function'] = $this->session->userdata['function'];
			$data2['name'] = $this->session->userdata['name'];
			$data['data'] = $data2;
		}

		$data['main_content'] = 'welcome';
		$this->load->view('template', $data);

	}

  function loadNotes()
  {
      if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
        $data['logged_in'] = false;
        $data['main_content'] = 'login';
        $this->load->view('template', $data);
      } else {
        $data['logged_in'] = true;
        $data['function'] = $this->session->userdata['function'];
        $data['main_content'] = 'mynotes';
        $this->load->view('template', $data);
      }
  }

	function getNotes()
	{
		header('Content-type: application/json');
		if ($this->session->userdata['logged_in'] == false)
		{
			return false;
		}
		$query = $this->notemodel->getNotesByUser($this->session->userdata['id']);

		echo json_encode($query);
	}

  function createNote()
  {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'xss_clean|trim|htmlspecialchars');
		$this->form_validation->set_rules('content', 'Content','xss_clean|trim|htmlspecialchars');

		if (($this->form_validation->run()))
		{
	    $data = array(
	      'user' => $this->session->userdata['id'],
	      'date' => date("Y/m/d"),
	      'name' => $_POST['title'],
	      'content' => $_POST['content'],
	      'color' => "red",
	     );
	     $this->notemodel->addNote($data);
    }
		else
		{
			print ("nie nie");
		}

		//$this->loadNotes();
		redirect('/NoteController/loadNotes');

  }

  function editNote($id)
  {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'xss_clean|trim|htmlspecialchars');
		$this->form_validation->set_rules('content', 'Content','xss_clean|trim|htmlspecialchars');

		if (($this->form_validation->run()))
		{
	    $data = array(
	      'user' => $this->session->userdata['id'],
	      'date' => date("Y/m/d"),
	      'name' => $_POST['title'],
	      'content' => $_POST['content'],
	      'color' => "red",
	     );
	     $query = $this->notemodel->updateNote($id, $data);
			 if (!$query)
			 	print ("nie nie");
    }
		else
		{
			print ("nie nie");
		}

		//$this->loadNotes();
		redirect('/NoteController/loadNotes');
  }

  function removeNote($id)
  {
     $this->notemodel->deleteNote($id);
     redirect('/NoteController/loadNotes');
  }


}
