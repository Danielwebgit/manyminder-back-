<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {
    
    public function index_supplier()
    {
        $this->db->select('suppliers.id, users.username, suppliers.cnpj');
        $this->db->from('suppliers');
        $this->db->join('users', 'users.id = suppliers.user_id', 'inner');
        
        $query = $this->db->get();
        return $query->result();
       
    }

    public function store_supplier($formData)
    {
        return $this->db->insert('suppliers', $formData);
    }

    public function show_supplier(int $id)
    {
        $query = $this->db->get_where('suppliers', array('id' => $id));
        return $query->row_array();
    }

    public function update_supplier(int $id, array $input)
    {
        $query = $this->db->get_where('suppliers', array('id' => $id))->row_array();
  
        if($query){
            $this->db->update('suppliers', $input, array('id' => $id));
            return true;
        } else {
            return false;
        }
    }

    public function delete_supplier(int $id)
    {
        $query = $this->db->get_where('suppliers', array('id' => $id))->row_array();

        if($query){
            $this->db->delete('suppliers', array('id' => $id));
            return true;
        } else {
            return false;
        }
    }
}