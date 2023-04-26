<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions_model extends MY_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->table = 'permissions';
        $this->primary_key = 'id';
    }

    public function index_permissions()
    {
        $this->db->select('name, description');
        $this->db->from('permissions');
        return $this->db->get()->result();
    }
}