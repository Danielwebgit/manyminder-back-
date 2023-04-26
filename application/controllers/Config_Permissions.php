<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_Permissions extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permissions_model');
    }

    public function index()
    {
        $permissions = $this->Permissions_model->index_permissions();

        response_helper('permissions', $permissions);
    }
}