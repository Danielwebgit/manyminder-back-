<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require (APPPATH.'/libraries/REST_Controller.php');

use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller {


    public function __construct()
	{
		parent::__construct();
        $this->load->library('Authorization_Token');
        $this->CI =& get_instance();
	}

    public function index_post()
    {
        $this->load->model('User_model');
        
        $token_data['email'] = $this->input->post('email');
        $token_data['password'] = $this->input->post('password');

        // Verifica as credenciais de login
        $user = $this->User_model->login_user($token_data['email'], $token_data['password']);
        
        if ($user) {
            $token_data['id'] = (int) $user->id;
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