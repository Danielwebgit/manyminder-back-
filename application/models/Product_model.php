<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    

    public function index_product()
    {
  
        $this->db->select('products.id, products.name, products.description, products.priceUn, products.supplier_id, products.activated, users.username');
        $this->db->from('products');
        $this->db->join('suppliers', 'suppliers.id = products.supplier_id', 'inner');
        $this->db->join('users', 'users.id = suppliers.user_id', 'inner');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
   
        return $query->result();
    }

    public function store_product($formData)
    {
        $formDatasss = $formData;
        return $this->db->insert('products', $formData);
    }

    public function get_paginacao($limit, $start) {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get('products')->result_array();
      }

      
      
      public function get_count() {
        return $this->db->count_all_results('products');
      }

    public function show_product(int $id)
    {
        $query = $this->db->get_where('products', array('id' => $id));

        if($query) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function update_product(int $id, $input)
    {
      
        $query = $this->db->get_where('products', array('id' => $id))->row_array();
        
        if($query) {
            $this->db->from('products');
            $this->db->set($input);
            $this->db->where('id', $id);
            $grg = $this->db->update();
            $fr = 'cdsc';
            return true;
        } else {

            return false;
        }
    }

    public function delete_product(int $id)
    {
        $query = $this->db->get_where('products', array('id' => $id))->row_array();

        if($query) {
            $this->db->delete('products', array('id' => $id));
            return true;
        } else {
            return false;
        }
    }
}