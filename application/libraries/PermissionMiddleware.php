<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PermissionMiddleware
{
    protected $ci;
    protected $permission;

    public function __construct($params = array())
    {
        $this->ci =& get_instance();
        $this->permission = isset($params[0]) ? $params[0] : null;
    }

    public function run()
    {
        $user_id = $this->ci->session->userdata('user_id');
        if (!$this->ci->permission_model->check_permission($this->permission, $user_id)) {
            show_error('Você não tem permissão para acessar esta página.');
        }
    }
}
