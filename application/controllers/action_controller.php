<?php

class Action_controller extends CI_Controller{

	public function index(){
		$content['warning'] = 'Заполните все поля';
		$this->load->view('autorisation_view', $content);	
	}

	public function autorisation(){
		if (isset($_POST['to_checkin'])) {
			$content['warning'] = 'Заполните все поля';
			$this->load->view('checkin_view', $content);
		}
		if (isset($_POST['signin_ws'])) {
			$newdata = array('user_id' => 0);
			$this->session->set_userdata($newdata);
			$this->load->model('action_model');	
			$data['contacts'] = $this->action_model->get_contacts(0);
			$this->load->view('users_ws',$data);
		}
		if (isset($_POST['signin'])) {
			if(!empty($_POST['mail']) && !empty($_POST['password'])){
				$add['mail'] = $this->input->post('mail');
				$add['password'] = $this->input->post('password');
				$this->load->model('action_model');
				$data = $this->action_model->signin($add);
				if ($data) {
					$newdata = array(	'user_id' => $data[0]['user_id'],
										'user_mail' => $data[0]['mail'],
										'user_firstname' => $data[0]['firstname'],
										'user_surname' => $data[0]['surname']);
					$this->session->set_userdata($newdata);
					$this->load->model('action_model');
					$newdata = $this->session->userdata();
					$newdata['comments'] = $this->action_model->get_comments($newdata['user_id']);
					$this->load->view('mypage_view',$newdata);
				}
				else{
					$content['warning'] = 'Введите данные правильно';
					$this->load->view('autorisation_view', $content);	
				}
			}
			else
				$this->index();
		}
	}

	public function checkin(){
		if (isset($_POST['back'])) 
			$this->index();

		if (isset($_POST['checkin'])) {
			if (!empty($_POST['firstname'])	&&
				!empty($_POST['surname'])	&&
				!empty($_POST['mail'])		&&
				!empty($_POST['password'])	&&
				!empty($_POST['password1'])	) {
				if ($_POST['password'] == $_POST['password1']) {
					$add['firstname'] = $this->input->post('firstname');
					$add['surname'] = $this->input->post('surname');
					$add['mail'] = $this->input->post('mail');
					$add['password'] = $this->input->post('password');

					$this->load->model('action_model');
					$data = $this->action_model->get_users($add['mail']);
					if ($data) {
						$content['warning'] = 'Такой email уже используется';
						$this->load->view('checkin_view', $content);
					}
					else{
						$this->db->insert('users',$add);
						$content['warning'] = "Спасибо за регистрацию <br> Теперь авторизуйтесь";
						$this->load->view('autorisation_view', $content);
					}
				}
				else{
					$content['warning'] = 'Введенные пароли не совпадают';
					$this->load->view('checkin_view', $content);
				}	
			}
			else{
				$content['warning'] = 'Вы заполнили не все поля';
				$this->load->view('checkin_view', $content);
			}
		}
	}

	public function ajax_on_mypage(){
		$page_id = $this->session->userdata('user_id');
		$count = $this->input->post('count');
		$this->load->model('action_model');
		$comments = $this->action_model->get_comments($page_id[0], $count);
		echo json_encode($comments);
	}

} 