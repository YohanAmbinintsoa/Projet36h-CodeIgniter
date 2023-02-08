<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require("BaseController.php");
class RoutesController extends BaseController{
    public function index()
    { 
        $page='main';
        if(isset($_GET['page'])){
            $page=$_GET['page'];
        }
        $data['content']=$page;
        $this->load->view('templates/template',$data);
    }
    public function detail()
    {
        $this->load->model('DatabaseAcces','base');
        $array=$this->base->getProductById($_GET['id']);
        $data['other']=$this->base->getProducts($_SESSION['id']);
        $data['produit']=$array;
        $image=$this->base->getAllImages($_GET['id']);
        if (isset($image)&&!empty($image)) {
            $data['image']=$image;
        }      
        $data['content']='detail';
        $this->load->view('templates/template',$data);
    }
    public function produit(){
        $this->load->model('DatabaseAcces','base');
        $array=$this->base->getProducts($_SESSION['id']);
        $data['produit']=$array;
        $data['content']='produits';
        $this->load->view('templates/template',$data);
    }
    public function allProduit(Type $var = null)
    {
        $this->load->model('DatabaseAcces','base');
        $array=$this->base->getAllProducts($_SESSION['id']);
        $data['produit']=$array;
        $data['content']='produits';
        $this->load->view('templates/template',$data);
    }

    public function add()
    {
        $this->load->model('DatabaseAcces','base');
        $data['categories']=$this->base->getAllCategories();
        $data['content']='insert';
        $this->load->view('templates/template',$data);
    }
    public function echange()
    {
        $this->load->model('DatabaseAcces','base');
        $idEntana1=$_GET['idEntana1'];
        $idEntana2=$_GET['idEntana2'];
        $this->base->insertDemand($idEntana1,$idEntana2);
        redirect("RoutesController/produit");
    }
    public function demand()
    {
        $this->load->model('DatabaseAcces','base');
        $array=$this->base->getAllDemand($_SESSION['id']);
        $data['content']='demandes';
        $data['demande']=$array;
        $this->load->view('templates/template',$data);
    }
    public function admin()
    {
        $this->load->model('DatabaseAcces','base');
        $data['categories']=$this->base->getAllCategories();
        $data['content']='admin';
        $this->load->view('templates/template',$data);
    }
    public function detailEchange()
    {
        $this->load->model('DatabaseAcces','base');
        $id=$_GET['idEchange'];
        $array=$this->base->getDemandById($id);
        $objet1=$this->base->getProductById($array['idEntana1']);
        $objet2=$this->base->getProductById($array['idEntana2']); 
        $data['echange']=$array;
        $data['objet1']=$objet1;
        $data['objet2']=$objet2;      
        $data['content']='echange';
        $this->load->view('templates/template',$data);
    }
    public function accepter()
    {
        $id=$_GET['idEchange'];
        $this->load->model('DatabaseAcces','base');
        $this->base->accept($id);
        $this->demand();
    }
    public function refuser()
    {
        $id=$_GET['idEchange'];
        $this->load->model('DatabaseAcces','base');
        $this->base->refuser($id);
        $this->demand();
    }
    public function insertCat()
    {
        $this->load->model('DatabaseAcces','base');  
        $nom=$_POST['categorie'];
        $this->base->insertCat($nom);
        $this->admin();
    }
    public function modifyCat()
    {
        $this->load->model('DatabaseAcces','base');  
        $nom=$_POST['categorie'];
        $id=$_POST['idCategorie'];
        $this->base->modifyCat($id,$nom);
        $this->admin();
    }
}