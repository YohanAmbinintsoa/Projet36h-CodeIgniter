<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormControll extends CI_Controller{
    //Sign up validation
    public function sign(){
        $this->load->model('DatabaseAcces','sign');
        //Rules
        $this->form_validation->set_rules('user','Username','required',
        array(
            'required'=>'%s is required'
        )
        );
        $this->form_validation->set_rules('pass','Password','required',
        array(
            'required'=>'%s is required'
        )
        );
        $this->form_validation->set_rules('passconf','Password confirmation','required|matches[pass]',
            array(
                'required'=>'please confirm your password',
                'matches'=>'password not match'
            )
        );
        $this->form_validation->set_rules('mail','Email','required',
        array(
            'required'=>'You must provide an %s'
        )
        );
        //Running validation
        if($this->form_validation->run()==FALSE){
            $this->load->view('Signup');
        } else {
            $user=$this->input->post('user');
            $pass=$this->input->post('pass');
            $mail=$this->input->post('mail');
            $id=$this->sign->sign($user,$pass,$mail);
            $this->session->set_userdata('username',$user);
            $this->session->set_userdata('id',$id);
            redirect('RoutesController/index');
        }
    }
    //Login Check
    public function Check()
    {    
        $this->load->model('DatabaseAcces','verify');
        $rules=array(
            array(
                'field' => 'user',
                'label' => 'Username',
                'rules' => 'trim|required',
                'errors'=> array(
                    'required' => '%s is required',
                ),
            ),
            array(
                'field'=>'pass',
                'label'=>'Password',
                'rules'=>'required',
                'errors'=> array(
                    'required' => '%s is required',
                ),
            )
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('Login');
            } else {
                $mail=$this->input->post('user');
                $pass=$this->input->post('pass');                
                $result=$this->verify->login($mail,$pass);
                if($result){
                    foreach($result as $row){
                        $this->session->set_userdata('username',$row->nom);
                        $this->session->set_userdata('id',$row->idUser);
                        $this->session->set_userdata('admin',$row->isAdmin);
                    }
                    redirect('RoutesController/index');
                } else {
                    redirect('Welcome?error=0');
                }
                
            }
        
    }
    public function logout(){
        $this->session->unset_userdata('username',$row->nom);
        $this->session->unset_userdata('id',$row->id);
        redirect('Welcome');
    }
    //Back to the login page
    public function Back(){
        redirect('Welcome');
    }
}