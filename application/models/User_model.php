<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function index_user()
    {
        $query = $this->db->query("
        SELECT DISTINCT u.id , u.username, u.activated, r.name FROM manyminder.users u 
        LEFT JOIN manyminder.rules_permissions rp ON u.id = rp.user_id LEFT JOIN manyminder.rules r 
        ON r.id = rp.rule_id  ORDER BY u.id DESC;
        ");
        
        return $query->result_array();
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