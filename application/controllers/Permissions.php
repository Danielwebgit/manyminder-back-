<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permissions_model');
    }

    protected function middleware()
    {
        return array('access_control');
    }

    public function index()
    {
        $products = $this->Permissions_model->index_permissions();
        response_helper('products', $products);
    }
}