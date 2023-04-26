<?php

require_once APPPATH . 'third_party/php-jwt/JWT.php';
require_once APPPATH . 'middlewares/Abstract/AbstractAuthorization.php';
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
        $headers = $this->CI->input->request_headers();
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $decodedToken = $this->validateToken($token);
        $route = $this->CI->router->class.'/'.$this->CI->router->method;
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