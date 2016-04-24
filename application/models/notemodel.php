<?php

class NoteModel extends CI_Model
{
	function addNote($data)
	{
		$success = $this->db->insert('notes', $data);
		return $success;
	}

	function updateNote($id, $data)
	{
		$this->db->where('id', $id);
		$success = $this->db->update('notes', $data);
		return $success;
	}

	function deleteNote($id)
	{
		$success = $this->db->delete('notes', array('id' => $id));

		return $success;
	}

	function getNote($id)
	{
		$this->db->where('id', $id);
		$success = $this->db->get_where('notes',array('id' => $id));
		return $success->result();
	}

	function getNotesByUser($userid)
	{
		$success = $this->db->get_where('notes',array('user' => $userid));
		return $success->result();
	}

}
