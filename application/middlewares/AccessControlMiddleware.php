<?php

require_once APPPATH . 'third_party/php-jwt/JWT.php';
require_once APPPATH . 'middlewares/Abstract/AbstractAuthorization.php';

use Firebase\JWT\JWT;
use Abastract\AbstractAuthorization;

class AccessControlMiddleware extends AbstractAuthorization {
    
    protected $controller;
    protected $CI;
    public $roles = array();
    private $authorization_token;

    protected $access = "products/*";

    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->CI =& get_instance();
        $this->CI->load->model('Rules_permissions_model');
    }

    public function run()
    {
        //$auth_header = $this->CI->input->get_request_header('Authorization', FALSE);
       
        $headers = $this->CI->input->request_headers();

        

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        
        // if(isset($headers['Authorization']) == true) {
            
        //     $token = str_replace('Bearer ', '', $headers['Authorization']);
        // } else {
        //     response_helper('message', 'Token ausente no cabeçalho!', 401);
        //     die;
        // }

        
        
        
        $decodedToken = $this->validateToken($token);
       
        
        //die(response_helper('error', $decodedToken));
        //response_helper('message', $decodedToken, 401);
        //$payload = JWT::decode($headers['Authorization'], 'eyJ0eXAiOiJKV1QiLCJhbGciTWvLUzI1NiJ9IiRkYXRhIg', array('HS256'));
     
        $route = $this->CI->router->class.'/'.$this->CI->router->method;
        //$user_id = $this->CI->session->userdata('user_id');
        
        $rules_permissions = $this->CI->Rules_permissions_model->index_rules_permissions($decodedToken->id);
        
        $permissions = [];

        foreach($rules_permissions as $rulesName) {
            $permissions[] = $rulesName['name'];
        }
        
        $isAllowed = in_array($route, $permissions);
        
        if(! $isAllowed){
            die(response_helper('error', 'Access denied'));
        }
            
    }
}