<?php


class UserController extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
    $this->load->model('notesmodel');
		//$this->load->helper(array('security'));
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

  function loadNotes()
  {

      if ( (!isset($this->session->userdata['logged_in'])) || ($this->session->userdata['logged_in'] != true) ) {
        $data['logged_in'] = false;
        $data['main_content'] = 'login';
        $this->load->view('template', $data);
      } else {
        $data['logged_in'] = true;
        $data['function'] = $this->session->userdata['function'];
        $query = $this->notemodel->getNotesByUser($this->session->userdata['id']);
        $data['data'] = $query;
        $data['main_content'] = 'mynotes';
        $this->load->view('template', $data);
      }
  }

  function createNote()
  {
    $data = array(
      'user' => $this->session->userdata['id']),
      'date' => date("Y/m/d"),
      'name' => $_POST['name'],
      'content' => $_POST['content'],
      'color' => $_POST['color'],
     );
     $this->notemodel->addNote($data);
     loadNotes();
  }

  function editNote()
  {
    $data = array(
      'id' => $_POST['id'],
      'user' => $this->session->userdata['id']),
      'date' => date("Y/m/d"),
      'name' => $_POST['name'],
      'content' => $_POST['content'],
      'color' => $_POST['color'],
     );
     $this->notemodel->editNote($data);
     loadNotes();
  }

  function removeNote($id)
  {
     $this->notesmodel->removeNote($id);
     loadnotes();
  }
}
