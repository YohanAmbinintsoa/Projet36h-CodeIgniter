<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseHandler extends CI_Controller {
    
    public function search(){
        $query=$this->input->get('search');
        $this->load->model('DatabaseAcces','access');
        $row=$this->access->getUsers($query);
        $data['data']=$row;
        $data['content']='main';
        $this->load->view('templates/template',$data);
    }
    public function insertProduit()
    {
        $nom=$_POST['nom'];
        $descri=$_POST['description'];
        $prix=$_POST['prix'];
        $categorie=$_POST['categorie'];
        $this->load->model('DatabaseAcces','access');
        $this->access->insertProduit($nom,$descri,$prix,$categorie,$_FILES,$_SESSION['id']);
        redirect('RoutesController/produit');
    }
}