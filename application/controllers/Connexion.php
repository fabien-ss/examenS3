<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Connexion extends CI_Controller {

	public function disconnect(){
        $this->session->sess_destroy();
        redirect("Welcome/index");
    }
	public function newUser(){
        $nom = $this->input->post('nom');
        $email = $this->input->post('email');
        $numero = $this->input->post('numero');
        $password = $this->input->post('password');
        $password1 = $this->input->post('password1');
        $prenom = $this->input->post('prenom');
        $this->load->model('userrequest_model');
		try{
            $this->userrequest_model->checkPassword($password, $password1);
			$this->userrequest_model->insertNewUser($nom, $email, $numero, $password,$prenom);
            redirect("Welcome/index");
            //echo "mety";
        }
        catch(Exception $e){
            //echo "tsia";
			redirect("Connexion/inscription");
        }
    }
	public function inscription(){
		$this->load->view('Inscription');
	}
	
    public function loadAccueil($data){
        $this->load->view('Header');
        $this->load->view('Accueil', $data);
    }
    public function loadAdminSpace($data){
        $this->load->view('AdminHeader');
        $this->load->view('EspaceAdmin', $data);
    }
	public function Login()
	{
		$email = $this->input->post("email");
        $password = $this->input->post("password");
        $this->load->model('utils_model');
        $bool = $this->utils_model->checkUser($email, $password);
        if($bool){
            $data = $_SESSION['user'];
///$data = array("email" => "Adala");
            if($data['estadmin'] != 10) $this->loadAccueil($data);
            if($data['estadmin'] == 10) $this->loadAdminSpace($data);
        }
        else if(!$bool){
            redirect('Welcome/index');
        }
	}		
}
