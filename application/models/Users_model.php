<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

    public function __construct() {
        $this->table = 'users';
        $this->primary_key = 'id';
        $this->has_many['rules_users'] = array('local_key'=>'id', 'foreign_key'=>'user_id', 'foreign_model'=>'Rules_users_model');
        parent::__construct();
    }

    public function index_user()
    {
        $this->load->model('users_model');

        $this->db->select('users.id , users.username, users.telefone , users.activated, rules.name');
        $this->db->from('users');
        $this->db->join('rules_users', 'rules_users.user_id = users.id', 'left');
        $this->db->join('rules', 'rules.id = rules_users.rule_id', 'left');
        return $this->db->get()->result_array();
    }

    public function store_user($formData)
    {
        $this->db->insert('users', $formData);
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