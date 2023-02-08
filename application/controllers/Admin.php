<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
	 	parent::__construct();
		$this->load->library('session');
		if(!$this->session->has_userdata('user')){
			redirect("Welcome/index");
		}
	}
    
    public function getStatistique(){
        $this->load->model('Admin_model');
        $data['nombreuser'] = $this->Admin_model->getNombreDutilisateur();
        $nombredechange['nombreechange'] = $this->Admin_model->countEchange();
        $this->load->view('AdminHeader');
        $this->load->view('NombreUtilisateur', $data);
        $this->load->view('NombreEchange', $nombredechange);
    }

    public function afficherCategorie(){
        $this->load->model('Admin_model');
        $data['categorie'] = $this->Admin_model->getCategorie();
        $this->load->view('AdminHeader');
        $this->load->view('ListeCategorie', $data);
    }
    public function getListeObjet($id){
        $this->load->model('Admin_model');
        $data['objets'] = $this->Admin_model-> getObjetByCategorie($id);
        $this->afficherCategorie();
        $this->load->view('ListeObjetByCategorie', $data);
    }
}
