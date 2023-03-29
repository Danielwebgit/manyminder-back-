<?php

class ProductAuthorizationMiddleware {

protected $CI;

public function __construct() {
    $this->CI =& get_instance();
    $this->CI->load->library('session');
}

public function handle() {
    // Verifica se o usuário está logado
    if (!$this->CI->session->userdata('logged_in')) {
        // Redireciona para a página de login
        redirect('login');
        return;
    }
    
    // Verifica se o usuário tem permissão para visualizar/editar produtos
    $user_role = $this->CI->session->userdata('user_role');
    if ($user_role != 'admin' && $user_role != 'editor') {
        // Retorna um erro HTTP 403 - Acesso Negado
        show_error('Você não tem permissão para acessar esta página', 403);
        return;
    }
    
    // Passa a requisição adiante
    return true;
}

}
