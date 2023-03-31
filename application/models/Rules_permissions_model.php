<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rules_permissions_model extends CI_Model {

    public function index_rules_permissions($userId)
    {
        
         ###########################################################
         $this->db->select('permission_id');
         $this->db->from('rules_permissions');
         $this->db->where_in('rule_id', );
         $this->db->order_by('id', 'DESC');
         $query = $this->db->get();
         response_helper('products', $query->result_array());
        die;
         return $query->result_array();
 
         ###########################################################
        
        $query = $this->db->query("SELECT permission_id  FROM rules_permissions WHERE rule_id IN ( SELECT rule_id FROM rules_users WHERE `user_id` = $userId)");
        response_helper('products', $query);
        die;
        foreach($query->result_array() as $ids) {
            $permissionIds[] = $ids['permission_id'];
        }


        ###########################################################
        $this->db->select('name');
        $this->db->from('permissions');
        $this->db->where_in('id', $permissionIds);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();

        ###########################################################


        ###########################################################
        
        $this->db->select('name');
        $this->db->from('permissions');
        $this->db->where_in('id', $permissionIds);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        return $query->result_array();
        
        // $query = $this->db->query("
        //     SELECT p.name FROM manyminder.permissions p
        //     WHERE p.id 
        //     IN ( SELECT rp.permission_id 
        //     FROM manyminder.rules_permissions rp WHERE rp.rule_id 
        //     IN ( SELECT ru.rule_id FROM manyminder.rules_users ru WHERE ru.user_id = $userId) )
        // ");

        
        // $this->db->select('rules_permissions.id, rules_permissions.user_id, users.username, permissions.name');
        // $this->db->from('rules_permissions');
        // $this->db->join('users', 'rules_permissions.user_id = users.id', 'inner');



        // print_r($query);
        // die;
        
        return $query->result_array();
    }

}