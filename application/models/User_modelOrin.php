<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {     
        
        public function als()
        {
                echo "auqlquer";
        }

        public function getRecord()     
        {
                //$this->load->database();
                $this->db->select('*');
                $this->db->from('collaborators');
                $query = $this->db->get()->result();

                echo "<pre>";
                print_r($query);
                echo "<pre>";
        }

        public function runQuery()
	{
        $data = array(
                'username' => 'João Lucas da Silva',
                'password' => '245w454',
                'telefone' => '61992815383',
                'email' => "jor@gmail.com",
                'admin_roles_id' => '1', 
                'activated' => true
        );
        }
}
