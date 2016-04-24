<?php

class UserModel extends CI_Model
{
	function addUser($data)
	{
		$success = $this->db->insert('users', $data);
		return $success;
	}

	function updateUser($id, $data)
	{
		$this->db->where('id', $id);
		$success = $this->db->update('users', $data);
		return $success;
	}

	function deleteUser($id)
	{
		$success = $this->db->delete('users', array('id' => $id));

		return $success;
	}

	function getUser($id)
	{
		$this->db->where('id', $id);
		$success = $this->db->get_where('users',array('id' => $id));
		return $success->result();
	}

	function getUsers()
	{
		$success = $this->db->get_where('users',array('role_id' => 2));
		return $success->result();
	}

	function checkPassword($password, $email)
	{
    $this -> db -> from('users');
		$this -> db -> where('email', $email);
		$this -> db -> where('password', $password);
		$query = $this -> db -> get();

		if ($query->num_rows() == 1)
		{
			return true;
		} else {
		  return false;
		}

	}

	function getByEmail($email){
		//$this->db->select('id, function, name, lastname, email');
		$query = $this->db->where('email', $email)->limit(1)->get('users');

		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return false;
	}

	function checkPermission($email)
	{
		$this -> db -> select('role_id');
		$this -> db -> from('users');
		$this -> db -> where('email', $email);
		$query = $this -> db -> get();
		if ($query->result()['0']->role_id == 0) {
			return true;
		} else {
			return false;
		}
	}

}
