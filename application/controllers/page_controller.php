<?php

class Page_controller extends CI_Controller{

	public function mypage_comments(){
		if (isset($_POST['comment']) && !empty($_POST['comment_text']) && !empty($_POST['comment_head'])) {
			$add['page_id'] = $this->session->userdata('user_id');
			$add['author_id'] = $this->session->userdata('user_id');
			$add['comment_head'] = $this->input->post('comment_head');
			$add['comment_text'] = $this->input->post('comment_text');
			$this->load->model('action_model');
			$this->action_model->add_comment($add);
			$newdata = $this->load_mypage_comments();
			$this->load->view('mypage_view',$newdata);
		}
	}

	public function signout(){
		if (isset($_POST['signout'])) {
			$this->session->sess_destroy();
			$content['warning'] = 'Заполните все поля';
			$this->load->view('autorisation_view', $content);	
		}
	}

	public function contacts(){	
		if (isset($_POST['contacts'])) {
			$data = $this->get_other_contacts();
			$this->load->view('contacts_view',$data);
		}
	}

	public function get_other_contacts(){
		$session_id = $this->session->userdata('user_id');
		$this->load->model('action_model');	
		$data['contacts'] = $this->action_model->get_contacts($session_id);	
		return $data;
	}

	public function back_to_mypage(){
		if (isset($_POST['back_to_mypage'])) {
			$newdata = $this->load_mypage_comments();
			$this->load->view('mypage_view',$newdata);			
		}
	}

	public function seemycomments(){
		$newdata = $this->session->userdata();
		$this->load->model('action_model');
		$comments['comments'] = $this->action_model->get_all_comments($newdata['user_id']);
		$this->load->view('mycomments_view', $comments);
	}

	public function load_mypage_comments(){
		$newdata = $this->session->userdata();
		$this->load->model('action_model');
		$newdata['comments'] = $this->action_model->get_comments($newdata['user_id']);
		return $newdata;
	}

	public function to_user(){
		$data = $this->get_other_contacts();
		foreach ($data['contacts'] as $item) {
			if (isset($_POST['open'.$item['user_id']])) {
				$newdata['on_page'] = array($item['user_id']);
				$this->session->set_userdata($newdata);
				$this->load_userpage_view($item['user_id']);
			}
		}
	}

	public function load_userpage_view($page){
		$this->load->model('action_model');
		$newdata = $this->session->userdata();
		$newdata['comments'] = $this->action_model->get_comments($page);
		$newdata['about_user'] = $this->action_model->about_user($page);
		if ($newdata['user_id'] == 0) 
			$this->load->view('userpage_ws',$newdata);
		else
			$this->load->view('userpage_view',$newdata);
	}

	public function userpage_comments(){
		$data = $this->get_other_contacts();
		foreach ($data['contacts'] as $item) {
			if (isset($_POST['comment'.$item['user_id']]) && !empty($_POST['comment_text']) && !empty($_POST['comment_head'])) {
				$add['page_id'] = $item['user_id'];
				$add['author_id'] = $this->session->userdata('user_id');
				$add['comment_head'] = $this->input->post('comment_head');
				$add['comment_text'] = $this->input->post('comment_text');
				$this->load->model('action_model');
				$this->action_model->add_comment($add);
				$this->load_userpage_view($item['user_id']);
			}
		}
	}

	public function action_comment(){
		$this->load->model('action_model');
		$comments = $this->action_model->get_all_comments();
		foreach ($comments as $item) {
			if (isset($_POST['delete'.$item['comment_id']])){
				$item['comment_delete'] = 1;
				$this->action_model->delete_comment($item);
				$this->load_userpage_view($item['page_id']);
			}
			if(isset($_POST['answer'.$item['comment_id']])){
				$this->load->view('answer_view',$item);
			}
			if (isset($_POST['comment'.$item['comment_id']])) {
				$answer['answer_to'] = $item['comment_id'];
				$answer['page_id'] = $item['page_id'];
				$answer['author_id'] = $this->session->userdata('user_id');
				$answer['comment_head'] = $this->input->post('comment_head');
				$answer['comment_text'] = $this->input->post('comment_text');
				$this->action_model->add_comment($answer);
				$this->load_userpage_view($item['page_id']);
			}
		}
	}

	public function ajax(){
		$count = $this->input->post('count');
		$user_id = $this->session->userdata('user_id');
		$this->load->model('action_model');
		$comments = $this->action_model->get_all_comments($user_id, $count);
		echo json_encode($comments);
	}

	public function ajax_on_userpage(){
		$page_id = $this->session->userdata('on_page');
		$count = $this->input->post('count');
		$this->load->model('action_model');
		$comments = $this->action_model->get_comments($page_id[0], $count);
		echo json_encode($comments);
	}

	public function back_ws(){
		$this->load->model('action_model');	
		$data['contacts'] = $this->action_model->get_contacts(0);
		$this->load->view('users_ws',$data);
	}



}