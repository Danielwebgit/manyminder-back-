<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collaborators_model extends CI_Model {

    public function register()
    {
        echo print_r($_POST); die;
        echo "<h1>Registrando aqui</>";
    }

    public function getRecord()    
    {
        $this->db->select('*');
        $this->db->from('collaborators');
        $query = $this->db->get()->result();

        echo "<pre>";
        print_r($query);
        echo "<pre>";
    }

    public function runQuery()
    {

        echo print_r($_POST);
        // $data = array(
        //     'username' => 'João Lucas da Silva',
        //     'password' => '245w454',
        //     'telefone' => '61992815383',
        //     'email' => "jor@gmail.com",
        //     'admin_roles_id' => '2', 
        //     'activated' => true
        // );

        // $this->db->insert('collaborators', $data);
    }

    public function update()
    {
        $data = array(
            'username' => 'Alterei aqui hehe',
            'password' => '245w454',
            'telefone' => '61992815383',
            'email' => "jor@gmail.com",
            'admin_roles_id' => '1', 
            'activated' => true
        );

        $this->db->where('id', 2);
        $this->db->update('collaborators', $data);
    }

    public function delete()
    {
        $this->db->where('id', 1);
        $this->db->delete('collaborators');
        echo $this->db->last_query();
    }

    
}