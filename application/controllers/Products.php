<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {


    public function index()
    {
        $this->load->model('Product_model');

        $products = $this->Product_model->index_product();
        response_helper('products', $products);
    }

    public function store()
    {
        $formData['name'] = $this->input->post('name');
        $formData['description'] = $this->input->post('description');
        $formData['priceUn'] = $this->input->post('priceUn');
        $formData['supplier_id'] = $this->input->post('supplier_id');
        $formData['activated'] = $this->input->post('activated');

        $this->load->model('Product_model');
        $insertProduct = $this->Product_model->store_product($formData);

        if($insertProduct) {
            response_helper('message', 'Produto adicionado com sucesso!');
        } else {
            response_helper('message', 'Error ao inserir!', 401);
        }
    }

    public function show($id)
    {
        $this->load->model('Product_model');
        $product = $this->Product_model->show_product($id);

        response_helper('product', $product);
    }

    public function update($id)
    {
        $formData = $this->input->post();

        $this->load->model('Product_model');
        
        $updateProduct = $this->Product_model->update_product($id, $formData);
        
        if($updateProduct) {
            response_helper('message', 'Produto atualizado com sucesso!');
        } else {
            response_helper('message', 'Error ao atualizar', 401);
        }
    }

    public function delete($id)
    {
        $this->load->model('Product_model');

        $deleteProduct = $this->Product_model->delete_product($id);
        
        if($deleteProduct) {
            response_helper('message', 'Produto deletado com sucesso!');
        } else {
            response_helper('message', 'Error ao deletar!');
        }
    }
}