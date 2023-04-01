<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends MY_Model {

    public function __construct() {
        $this->table = 'users';
        $this->primary_key = 'id';
        $this->has_many['rules_users'] = array('local_key'=>'id', 'foreign_key'=>'user_id', 'foreign_model'=>'Rules_users_model');
        parent::__construct();
        // $this->table = 'users';
        // $this->primary_key = 'id';
    }

    public function index_user()
    {
        // $this->load->model('rules_model');
        // $this->rules_model->with('rules');

        // $this->db->select('users.id , users.username, users.telefone , users.activated');
        // $this->db->from('users');
        // $this->db->join('rules_users', 'users.id = rules_users.user_id', 'left');
        // $this->db->join('rules', 'rules.id = rules_users.rule_id', 'left');
        
        // $query = $this->db->get();
        // response_helper('users', $query->result_array());


        ##############################


        $this->load->model('users_model');
        $rules_users = $this->users_model->where('id', 4)->with_rules_users('fields:rule_id, user_id')->get_all();

        $rulesId = [];

        foreach($rules_users as $item) {
            $rulesId[] = $item->rules_users;
        }


        response_helper('users', $rulesId);


        //return $query->result_array();
        // $query = $this->db->query("
        // SELECT DISTINCT u.id , u.username, u.telefone , u.activated FROM manyminder.users u 
        // LEFT JOIN manyminder.rules_users ru ON u.id = ru.user_id LEFT JOIN manyminder.rules r
        // ON r.id = ru.rule_id  ORDER BY u.id DESC;
        // ");

        
        // $this->load->model('Rules_model');
        // $rules = $this->Rules_model->find(1);

        // $categoria = $rules->rules();
        // print_r($categoria);
        
        // die;
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

    // public function rules_users()
    // {
    //     return $this->belongs_to('Rules_users_model', 'rule_id');
    // }
}