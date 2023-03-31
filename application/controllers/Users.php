<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	// protected function middleware()
    // {
    //     return array('access_control');
    // }


	public function index()
	{
		$this->load->model('rules_users_model');
		$rules_users = $this->rules_users_model->with('users')->get_all();
		response_helper('users', $rules_users);
		die;
		//$users = $this->user_model->index_user();
		
		response_helper('users', $users);
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
