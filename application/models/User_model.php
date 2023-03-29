<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function index_user()     
    {
        $this->db->select('*');
        $this->db->from('users');
        return $this->db->get()->result();
    }

    public function store_user($formData)
    {
        $this->db->insert('users', $formData);
    }

    public function update_user($userId)
    {
        
    }

    public function show_user($userId)
    {

    }
    
    public function login_user($email, $password)
    {
        $user = $this->db->get_where('users', array('email' => $email))->row();
         // Verifica se o usuário existe e se a senha está correta
         if ($user && password_verify($password, $user->password)) {

            // Retorna o usuário se as credenciais estiverem corretas
            return $user;
        }

        // Retorna false se as credenciais estiverem incorretas
        return false;
    }
}