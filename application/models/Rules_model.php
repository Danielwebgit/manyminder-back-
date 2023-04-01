<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_model extends MY_Model {

    public function __construct()
    {
        $this->table = 'rules';
        $this->primary_key = 'id';
        $this->has_many_pivot['rules_users_piv'] = array(
            
            'local_key'=>'id',

            'pivot_local_key'=>'rule_id',

            'pivot_table'=>'rules_users',

            'foreign_model'=>'Users_model',

            'foreign_key'=>'id',
            
            'pivot_foreign_key'=>'rule_id'
        );
        parent::__construct();
    }

    public function index_rules()
    {
        $this->db->select('*');
        $this->db->from('rules');
        $query = $this->db->get();
        return $query->result();
    }
}