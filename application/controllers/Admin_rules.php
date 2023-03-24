<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_rules extends CI_Controller {


    public function index()
    {
        $this->load->model('Admin_rules_model');

        $adminRules = $this->Admin_rules_model->index_admin_rules();
        $this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode(array('Rules' => $adminRules))); 
    }

    public function store()
    {
        $formData['name'] = $this->input->post('name');

        $this->load->model('Admin_rules_model');
        $insertProduct = $this->Admin_rules_model->store_admin_rules($formData);

        if($insertProduct){
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('message' => 'Regra adicionado com sucesso!'))); 
        } else {
            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Error ao inserir')));
        }
    }

    public function show($id)
    {
        $this->load->model('Admin_rules_model');
        $rule = $this->Admin_rules_model->show_admin_rules($id);
        
        $this->output
		->set_status_header(200)
		->set_content_type('application/json')
		->set_output(json_encode(array('rule' => $rule))); 
    }

    public function update($id)
    {
        $this->load->model('Admin_rules_model');
        
        $formData = $this->input->post();

        $updateAdminRules = $this->Admin_rules_model->update_admin_rules($id, $formData);

        if($updateAdminRules){

            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('message' => 'Regra atualizado com sucesso!'))); 
        } else {

            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Error ao atualizar')));
        }
    }

    public function delete($id)
    {
        $this->load->model('Admin_rules_model');

        $deleteAdminRules = $this->Admin_rules_model->delete_admin_rules($id);
        
        if($deleteAdminRules){
            
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('message' => 'Regra deletada com sucesso!'))); 
        } else {

            $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Error ao deletar')));
        }
    }
}