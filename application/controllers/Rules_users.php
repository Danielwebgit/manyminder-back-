<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_users extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rules_users_model');
    }

    public function index()
    {
        $rules_users = $this->Rules_users_model->index_rules_users();

        response_helper('rules_users', $rules_users);
    }
}