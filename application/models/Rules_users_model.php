<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_users_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->table = 'rules_users';
        $this->primary_key = 'id';
        $this->belongs_to['users'] = array('Users_model', 'id', 'primary_key' => 'user_id');
    }
    
    public function index_rules_users()
    {
        $query = $this->db->query("
        SELECT ru.id , ru.user_id, u.username, r.name, ru.rule_id FROM manyminder.rules_users ru LEFT JOIN manyminder.users u ON u.id = ru.user_id JOIN manyminder.rules r ON r.id = ru.rule_id ORDER BY id DESC
        ");
        
        return $query->result_array();
    }
}