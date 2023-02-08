<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DatabaseAcces extends CI_Model 
{
    public function login($mail,$pass){
        $query="select * from user where mail=%s or nom=%s and pass=%s";
        $query=sprintf($query,$this->db->escape($mail),$this->db->escape($mail),$this->db->escape($pass));
        $result=$this->db->query($query);
        if($result->num_rows()==1){
            return $result->result();
        } else {
            return false;
        }
    }
    public function sign($user,$pass,$mail){
        $query="insert into user values(NULL,%s,%s,%s,0)";
        $query=sprintf($query,$this->db->escape($user),$this->db->escape($mail),$this->db->escape($pass));
        $this->db->query($query);
        $sql="select idUser from user where mail=%s or nom=%s and pass=%s";
        $sql=sprintf($sql,$this->db->escape($user),$this->db->escape($mail),$this->db->escape($pass));
        $result=$this->db->query($sql);
        $id=0;
        foreach($result->result_array() as $row){
            $id=$row['idUser'];
        }
        return $id;
    }
    public function getProducts($idUser)
    {
        $array=array();
        $query="select idEntana,entana.nom as nom,description,prix,entana.idUser,user.nom as prop from entana join user on entana.idUser=user.idUser where entana.idUser=%s";
        $query=sprintf($query,$this->db->escape($idUser));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) {
            $array['id'][]=$row['idEntana'];
            $array['nom'][]=$row['nom'];
            $array['description'][]=$row['description'];
            $array['prix'][]=$row['prix'];
            $array['idUser'][]=$row['idUser'];
            $array['proprietaire'][]=$row['prop'];
            $img=$this->getAllImages($row['idEntana']);
            if (!empty($img)) {
                $array['image'][]=$img['path'][0]; 
            }else {
                $array['image'][]=null; 
            }         
        }
        return $array;
    }
    public function getAllProducts($idUser)
    {
        $array=array();
        $query="select idEntana,entana.nom as nom,description,prix,entana.idUser,user.nom as prop from entana join user on entana.idUser=user.idUser where entana.idUser!=%s";
        $query=sprintf($query,$this->db->escape($idUser));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) { 
            $array['id'][]=$row['idEntana'];
            $array['nom'][]=$row['nom'];
            $array['description'][]=$row['description'];
            $array['prix'][]=$row['prix'];
            $array['idUser'][]=$row['idUser'];
            $array['proprietaire'][]=$row['prop'];
            $img=$this->getAllImages($row['idEntana']);
            if (!empty($img)) {
                $array['image'][]=$img['path'][0]; 
            }else {
                $array['image'][]=null; 
            } 
        }
        return $array;
    }
    public function getAllCategories()
    {
        $array=array();
        $query="select * from categorie";
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) {
            $array['id'][]=$row['idCat'];
            $array['nom'][]=$row['nom'];           
        }
        return $array;
    }
    public function getProductById($id)
    {
        $array=array();
        $query="select idEntana,entana.nom as nom,description,prix,entana.idUser,user.nom as prop from entana join user on entana.idUser=user.idUser where idEntana=%s";
        $query=sprintf($query,$this->db->escape($id));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) {
            $array['id']=$row['idEntana'];
            $array['nom']=$row['nom'];
            $array['description']=$row['description'];
            $array['prix']=$row['prix'];
            $array['idUser']=$row['idUser'];  
            $array['proprietaire']=$row['prop']; 
            $img=$this->getAllImages($row['idEntana']);
            if (!empty($img)) {
                $array['image']=$img['path'][0]; 
            }else {
                $array['image']=null; 
            }        
        }
        return $array;
    }

    public function getAllImages($idProduit)
    {
        $array=array();
        $query="select * from sary where idEntana=%s";
        $query=sprintf($query,$this->db->escape($idProduit));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row) {
            $array['idSary'][]=$row['idSary'];
            $array['path'][]=$row['path'];
            $array['idEntana'][]=$row['idEntana'];
        }
        return $array;
    }

    public function insertImage($files,$idEntana)
    {
        // $files=$_FILES;
        $config['upload_path'] ='./assets/img/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;
        $config['max_width'] = 15000;
        $config['max_height'] = 15000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
            $files = $_FILES;
            for($i=0;$i<count($_FILES['files']['name']);$i++){
                $_FILES['files']['name']= $files['files']['name'][$i];
                $_FILES['files']['type']= $files['files']['type'][$i];
                $_FILES['files']['tmp_name']= $files['files']['tmp_name'][$i];
                $_FILES['files']['error']= $files['files']['error'][$i];
                $_FILES['files']['size']= $files['files']['size'][$i];  
                if($this->upload->do_upload('files')){
                    $name=$files['files']['name'][$i];
                    $query="insert into sary values(NULL,%s,%s)";
                    $query=sprintf($query,$this->db->escape($name),$this->db->escape($idEntana));
                    $this->db->query($query);
                } else {
                    print_r($this->upload->display_errors());
                }            
            } 
    }
    public function insertProduit($nom,$descri,$prix,$categorie,$image,$idUser)
    {
       $query="insert into entana values(NULL,%s,%s,%s,%s)";
       $query=sprintf($query,$this->db->escape($nom),$this->db->escape($descri),$this->db->escape($prix),$this->db->escape($idUser));
       $this->db->query($query);
       $sql=$this->db->query("select LAST_INSERT_ID() as id");
       $id=0;
       foreach ($sql->result_array() as $row) {
            $id=$row['id'];
       }    
       $count=count($categorie);
       for ($i=0; $i <$count ; $i++) { 
            $cat="insert into entanacategorie values(NULL,%s,%s)";
            $cat=sprintf($cat,$this->db->escape($categorie[$i]),$this->db->escape($id));
            $this->db->query($cat);
       }
       $this->insertImage($image,$id);
    }
    public function insertDemand($idEntana1,$idEntana2)
    {
        $query="insert into echange values(NULL,%s,%s,0,NULL)";
        $query=sprintf($query,$this->db->escape($idEntana1),$this->db->escape($idEntana2));
        $this->db->query($query);
    }
    public function getAllDemand($idUser)
    {
        $array=array();
        $query="select idEchange,idEntana1,e1.nom as nom1,e1.idUser as idUser1,u1.nom as user1,idEntana2,e2.nom as nom2,u2.nom as user2,u2.idUser as idUser2,dateAcceptation,etat from echange 
        inner join entana e1 on echange.idEntana1=e1.idEntana inner join entana e2 on echange.idEntana2=e2.idEntana
        left outer join user u1 on e1.idUser=u1.idUser left OUTER JOIN user u2 on e2.idUser=u2.idUser where e2.idUser=%s and etat=0";
        $query=sprintf($query,$this->db->escape($idUser));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row ) {
            $array['idEchange'][]=$row['idEchange'];
            $array['idEntana1'][]=$row['idEntana1'];
            $array['nom1'][]=$row['nom1'];
            $array['idUser1'][]=$row['idUser1'];
            $array['user1'][]=$row['user1'];
            $array['idEntana2'][]=$row['idEntana2'];
            $array['nom2'][]=$row['nom2'];
            $array['idUser2'][]=$row['idUser2'];
            $array['user2'][]=$row['user2'];
        }
        return $array;
    }
    public function getDemandbyId($id)
    {
        $array=array();
        $query="select idEchange,idEntana1,e1.nom as nom1,e1.idUser as idUser1,u1.nom as user1,idEntana2,e2.nom as nom2,u2.nom as user2,u2.idUser as idUser2,dateAcceptation,etat from echange 
        inner join entana e1 on echange.idEntana1=e1.idEntana inner join entana e2 on echange.idEntana2=e2.idEntana
        left outer join user u1 on e1.idUser=u1.idUser left OUTER JOIN user u2 on e2.idUser=u2.idUser where idEchange=%s";
        $query=sprintf($query,$this->db->escape($id));
        $result=$this->db->query($query);
        foreach ($result->result_array() as $row ) {
            $array['idEchange']=$row['idEchange'];
            $array['idEntana1']=$row['idEntana1'];
            $array['nom1']=$row['nom1'];
            $array['idUser1']=$row['idUser1'];
            $array['user1']=$row['user1'];
            $array['idEntana2']=$row['idEntana2'];
            $array['nom2']=$row['nom2'];
            $array['idUser2']=$row['idUser2'];
            $array['user2']=$row['user2'];
        }
        return $array;
    }
    public function accept($id)
    {
        $query="update echange set dateAcceptation=now(),etat=1 where idEchange=".$id;
        echo $query;
        $array=$this->getDemandbyId($id);
        $updateP1="update entana set idUser=".$array['idUser1']." where idEntana=".$array['idEntana2'];
        $updateP2="update entana set idUser=".$array['idUser2']." where idEntana=".$array['idEntana1'];
        $this->db->query($query);
        $this->db->query($updateP1);
        $this->db->query($updateP2);
    }
    public function refuser($id)
    {
        $query="update echange set dateAcceptation=now(),etat=-1 where idEchange=".$id;
        $this->db->query($query);
    }
    public function insertCat($nom)
    {
        $query="insert into categorie values(NULL,%s)";
        $query=sprintf($query,$this->db->escape($nom));
        $this->db->query($query);
    }

    public function modifyCat($id,$nom)
    {
        $query="update categorie set nom=%s where idCat=%s";
        $query=sprintf($query,$this->db->escape($nom),$this->db->escape($id));
        $this->db->query($query);
    }
    public function search($critera,$category)
    {
        $query="select ";
    }
}



   

