<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliers extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('Supplier_model');
    }

    protected function middleware()
    {
        return array('access_control');
    }

    public function index()
    {
        $this->load->model('Supplier_model');
        $suppliers = $this->Supplier_model->index_supplier();

        response_helper('fornecedores', $suppliers);
    }

    public function store()
    {
        $formData['cnpj'] = $this->input->post('cnpj');
        $formData['user_id'] = $this->input->post('user_id');

        $this->load->model('Supplier_model');

        $insertProduct = $this->Supplier_model->store_supplier($formData);

        if($insertProduct) {
            response_helper('message', 'Fornecedor adicionado com sucesso!');
        } else {
            response_helper('message', 'Error ao inserir');
        }
    }

    public function show($id)
    {
        $this->load->model('Supplier_model');

        $supplier = $this->Supplier_model->show_supplier($id);

        if($supplier) {
            response_helper('fornecedor', $supplier);
        } else {
            response_helper('message', 'Error ao vizualizar');
        }
    }

    public function update($id)
    {
        $this->load->model('Supplier_model');
        
        $formData = $this->input->post();

        $updateSupplier = $this->Supplier_model->update_supplier($id, $formData);

        if($updateSupplier) {
            response_helper('message', 'Fornecedor atualizado com sucesso!');
        } else {
            response_helper('message', 'Error ao atualizar!');
        }
    }

    public function delete($id)
    {
        $this->load->model('Supplier_model');

        $deleteSupplier = $this->Supplier_model->delete_supplier($id);
        
        if($deleteSupplier) {
            response_helper('message', 'Fornecedor deletado com sucesso!');
        } else {
            response_helper('message', 'Error ao deletar!');
        }
    }
}