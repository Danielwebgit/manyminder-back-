<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_permissions_model extends CI_Model {

    public function index_rules_permissions($userId)
    {
        
        $this->db->select('rules_permissions.id, rules_permissions.user_id, users.username, permissions.name');
        $this->db->from('rules_permissions');
        $this->db->join('users', 'rules_permissions.user_id = users.id', 'inner');
        $this->db->join('permissions', 'rules_permissions.permission_id = permissions.id', 'inner');
        $this->db->join('rules', 'rules.id = rules_permissions.rule_id', 'inner');
        
        $this->db->order_by('id', 'DESC');
        $this->db->where('user_id', $userId);
        $query = $this->db->get();
   
        return $query->result_array();
    }

}