<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_permissions_model extends MY_Model {

    protected $CI;

    public function __construct() {
        $this->has_many['permissions'] = array('foreign_model'=>'Rules_users_model','foreign_table'=>'users','foreign_key'=>'user_id','local_key'=>'id');
        parent::__construct();
        $this->load->model('permissions_model');
        $this->load->model('rules_permissions_model');
        $this->load->model('rules_users_model');
        $this->load->model('users_model');
        //$this->table = 'rules_permissions';
        // $this->primary_key = 'id';
        // $this->belongs_to['permissions'] = array('Permissions_model', 'id', 'primary_key' => 'rule_id');



    }

    public function index_rules_permissions($userId)
    {

        $ruleIds = [];
        $rules_users = $this->rules_users_model->where('user_id', $userId)->get_all();
        foreach($rules_users as $item) {
            $ruleIds[] = $item->rule_id;
        }

        $this->db->select('permission_id');
        $this->db->from('rules_permissions');
        $this->db->where_in('rule_id', $ruleIds);
        $query = $this->db->get()->result_array();

        $permissionIds = [];

        foreach($query as $item) {
            $permissionIds[] = $item['permission_id'];
        }

        $this->db->select('name');
        $this->db->from('permissions');
        $this->db->where_in('id', $permissionIds);
        $query = $this->db->get();

        return $query->result_array();
    }

}