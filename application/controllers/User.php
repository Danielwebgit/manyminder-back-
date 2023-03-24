<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function index()
	{
		$this->load->model('user_model');
		$users = $this->user_model->index_user();

		$this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode(array('users' => $users))); 
	}

	public function store()
	{
		$this->load->model('user_model');
		
		$formData['username'] = $this->input->post('username');
        $formData['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$formData['telefone'] = $this->input->post('telefone');
		$formData['email'] = $this->input->post('email');
		$formData['admin_roles_id'] = 4;
		$formData['activated'] = 1;

		$this->user_model->store_user($formData);

		response_helper('message', 'Usuário adicionado com sucesso!');

	}

	public function update($id = null)
	{
		$this->load->model('user_model');
		$record = $this->user_model->update_user();

	}

	public function show($id = null)
	{
		$this->load->model('user_model');
		$record = $this->user_model->show_user();

	}

	public function delete($id = null)
	{
		$this->load->model('user_model');
		$record = $this->user_model->delete_user();

	}
}
