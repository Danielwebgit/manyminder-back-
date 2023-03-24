<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rules_model extends CI_Model {
    
    public function index_admin_rules()
    {
        $query = $this->db->get('admin_rules');
        return $query->result_array();
    }

    public function store_admin_rules($formData)
    {
        return $this->db->insert('admin_rules', $formData);
    }

    public function show_admin_rules(int $id)
    {
        $query = $this->db->get_where('admin_rules', array('id' => $id));
        return $query->row_array();
    }

    public function update_admin_rules(int $id, array $input)
    {
        $query = $this->db->get_where('admin_rules', array('id' => $id))->row_array();
  
        if($query){
            $this->db->update('admin_rules', $input, array('id' => $id));
            return true;
        } else {
            return false;
        }
    }

    public function delete_admin_rules(int $id)
    {
        $query = $this->db->get_where('admin_rules', array('id' => $id))->row_array();

        if($query){
            $this->db->delete('admin_rules', array('id' => $id));
            return true;
        } else {
            return false;
        }
    }
}