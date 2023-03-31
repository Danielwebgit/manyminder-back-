<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends MY_Model {

    public function index_rules()
    {
        $this->db->select('*');
        $this->db->from('rules');
        $query = $this->db->get();
        return $query->result();
    }
}