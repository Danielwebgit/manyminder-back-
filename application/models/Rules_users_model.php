<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_users_model extends MY_Model {

    public function __construct() {
        $this->table = 'rules_users';
        $this->primary_key = 'id';
        $this->has_many['rules_users'] = 'Rules_users_model';
        parent::__construct();
        $this->load->model('rules_model');
        $this->load->model('rules_users_model');
        $this->load->model('users_model');
    }
    
    public function index_rules_users()
    {

       
        $rules = $this->rules_users_model->with_rules_users_piv('fields:username')->get_all();

        response_helper('rules', $rules);

        // $query = $this->db->query("
        // SELECT ru.id , ru.user_id, u.username, r.name, ru.rule_id FROM manyminder.rules_users ru LEFT JOIN manyminder.users u ON u.id = ru.user_id JOIN manyminder.rules r ON r.id = ru.rule_id ORDER BY id DESC
        // ");
        
        // return $query->result_array();
    }
}