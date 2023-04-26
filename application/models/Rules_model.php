<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends MY_Model {

    public function __construct()
    {
        $this->table = 'rules';
        $this->primary_key = 'id';
        parent::__construct();
    }

    public function index_rules()
    {
        $this->db->select('*');
        $this->db->from('rules');
        
        return $this->db->get()->result();
    }
}