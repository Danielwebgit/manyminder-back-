<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;


class Login extends REST_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Authorization_Token');
	}

    public function index_post()
    {
        $this->load->model('User_model');
        
        $token_data['username'] = $this->input->post('username');
        $token_data['password'] = $this->input->post('password');

        // Verifica as credenciais de login
        $user = $this->User_model->login_user($token_data['username'], $token_data['password']);

        if ($user) {
            // Cria um token JWT para o usuário
            $this->load->library('Authorization_Token');
            //$token = JWT::encode(array('user_id' => $user->id), $this->config->item('jwt_key'));
            $token = $tokenData['token'] = $this->authorization_token->generateToken($token_data);
            
            // Retorna o token JWT para o cliente
            response_helper('token', $token, 200);
        } else {

            // Retorna um erro se as credenciais estiverem incorretas
            response_helper('message', 'Invalid credentials', 401);
        }
    }

    public function verify_post()
	{
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		$this->response($decodedToken);  
	}
}