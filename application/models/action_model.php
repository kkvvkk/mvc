<?php 

class Action_model extends CI_Model {

	public function get_users($data){
		$query = $this->db->get_where('users', array('mail' => $data));
		return $query->result_array();
	}

	public function signin($data){
		$query = $this->db->get_where('users', array('mail' => $data['mail'],'password' => $data['password']));
		return $query->result_array();
	}
	
	public function get_contacts($data){
		$query = $this->db->get_where('users', array('user_id !=' => $data));
		return $query->result_array();
	}

	public function add_comment($data){
		$this->db->insert('comments', $data);
	}

	public function get_comments($data, $count = 0){
		$query = $this->db->get_where('comments', array('page_id' => $data), 5, $count);
		$array = $query->result_array();
		$result_array = array();
		foreach ($array as $item) {
			$author = $this->db->get_where('users', array('user_id' => $item['author_id']));
			$item['author'] = $author->result_array();
			array_push($result_array, $item);
		}
		return $result_array;
	}

	public function get_all_comments($data = 0, $count = 0){
		if ($data) {
			$query = $this->db->get_where('comments', array('author_id' => $data), 5, $count);
		}
		else
			$query = $this->db->get('comments');
		return $query->result_array();
	}

	public function about_user($data){
		$query = $this->db->get_where('users', array('user_id' => $data));
		return $query->result_array();
	}

	public function delete_comment($data){
		$update = array('comment_delete' => $data['comment_delete']);
		$this->db->where('comment_id', $data['comment_id']);
		$this->db->update('comments', $update);
	}

}