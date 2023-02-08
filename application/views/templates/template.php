<?php
if($content=='main'){
    $this->load->view('templates/landing');
} else {
    $this->load->view('templates/header');
}
$this->load->view('templates/'.$content);
$this->load->view('templates/footer');