<?php

class AuthMiddleware {

private $CI;

public function __construct()
{
    $this->CI =& get_instance();
}

public function check_login()
{
   
    // $this->load->library('session');
    // // Aqui você pode verificar se o usuário está logado
    // // Caso o usuário não esteja logado, você pode redirecioná-lo para a página de login
    // if(!$this->CI->session->userdata('logged_in')){
    //     redirect('login');
    // }
}

public function check_permission()
{
  
    // // Aqui você pode verificar se o usuário tem permissão para acessar a rota
    // // Caso o usuário não tenha permissão, você pode redirecioná-lo para uma página de erro ou exibir uma mensagem
    // $allowed_roles = ['admin', 'editor']; // Exemplo de perfis permitidos
    // $user_role = $this->CI->session->userdata('user_role'); // Exemplo de papel do usuário
    // // if(!in_array($user_role, $allowed_roles)){
    // //     show_error('Você não tem permissão para acessar esta página', 403);
    // // }
}

}
