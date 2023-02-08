<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LiveAction extends CI_Controller {
	 public function __construct()
	{
	 	parent::__construct();
		$this->load->library('session');
		if(!$this->session->has_userdata('user')){
			redirect("Welcome/index");
		}
	}
	public function loadResult($valiny){
		$this->load->view("Header");
		$this->load->view('ObjetDanslaMarge', $valiny);
		$this->load->view("Footer");
	}
	public function getObjetByMarge($id, $marge){
		$this->load->model('user_model');
		$data['data'] = $this->user_model->getObjetByIdObjet($id);
		//$this->load->helper('util_helper');
		$range[] = $this->user_model->getMarge($data, $marge); 
		$valiny['valiny'] = $this->user_model->getObjetInRange($range, $data);
		$this->loadResult($valiny);
	}
    // public function recherche(){
	// 	$recherche = $this->input->post('research');
	// 	$this->load->model('utils_model');
	// 	$data['data'] = $this->utils_model->findClient($recherche);
	// 	$this->load->view('ListeClient', $data);
	// }
	// public function findClient($id = ''){
	// 	$this->load->model('utils_model');
	// 	$data['data'] = $this->utils_model->findClientById($id);
	// 	$this->load->view('Client', $data);
	// }
	// public function getListeCustomers(){
	// 	$this->load->model('utils_model');
	// 	$data['data'] = $this->utils_model->getListeClient();
	// 	$this->load->view('ListeClient', $data);
	// }
	/*
	CREATE VIEW V_Demande AS
    SELECT e.idreceveur idutilisateur, e.etat, e.dateechange, u.nom, u.prenom, e.idobjet, o.designation, o.prixestimatif, p.nomphoto 
        FROM echange e
            JOIN objet o
                ON o.idobjet = e.idobjet
            JOIN utilisateur u
                ON u.idUtilisateur = e.idreceveur
            JOIN photo p
                ON p.idObjet = e.idobjet
        
            

	*/
	public function Historique(){
		$this->load->model('user_model');
		$data['data'] = $this->user_model->getHistorique();
		$this->load->view("Header");
		$this->load->view("Historique",$data);
		$this->load->view("Footer");
	}

	public function searchs(){
		$recherche = $this->input->post('research');
		$filtre = $this->input->post('filtrage');
		$this->load->model('user_model');
		$data['data'] = $this->user_model->recherche($recherche,$filtre);
		$this->load->view('Header');
		$this->load->view('search', $data);
		$this->load->view('Footer');
	}

	public function recherche(){
		$this->load->model('user_model');
		$data['data'] = $this->user_model->getAllCategorie();
		$this->load->view('Header');
		$this->load->view('Recherche', $data);
	}
	public function Inserer(){
		$this->load->model('user_model');
		$nom = $this->input->post("nom");
		$estimation = $this->input->post("estimation");
		$categorie = $this->input->post("idcategorie");
		$files['files'] = $_FILES['files'];
		$id = $_SESSION['user']['idutilisateur'];
		$this->user_model->insertion($nom, $estimation, $categorie, $id, $files);
		$this->InsererObjet();
	}
	public function InsererObjet(){
		$this->load->model('user_model');
		$data['data'] = $this->user_model->getAllCategorie();
		$this->load->view('Header');
		$this->load->view('InsererObjet', $data);
		$this->load->view('Footer');
		
		
	}
	public function getProposition(){
		$this->load->model('user_model');
		$id = $_SESSION['user']['idutilisateur'];
		$data['data'] = $this->user_model->getObjectPropose($id);
		$this->load->view('Header');
		$this->load->view('Proposition', $data);
		$this->load->view('Footer');
	}
	public function getAllObjects(){
		$this->load->model('user_model');
		$id=$_SESSION['user']['idutilisateur'];
		$data['data']=$this->user_model->getAllObject($id);
		$this->load->view('Header');
		$this->load->view('ListeObjet', $data);
		$this->load->view('Footer');
	}
	public function getmesobjets(){
		$this->load->model('user_model');
		$id=$_SESSION['user']['idutilisateur'];
		$data['data']=$this->user_model->getMesObject($id);
		$this->load->view('Header');
		$this->load->view('MesObjets', $data);
	}
	public function getPropreObjects(){
		$this->load->model('user_model');
		$id=$_SESSION['user']['idutilisateur'];
		$data['data']=$this->user_model->getObjetPropreObject($id);
		//$photo['photo']=$this->user_model->getPhotoById();
		$this->load->view('Header');
		$this->load->view('Echange', $data);
		$this->load->view('Footer');
	}
	public function getObjectById($idobject){
		$this->load->model('user_model');
		$data=$this->user_model->getObject($idobject);
		$id=$_SESSION['user']['idutilisateur'];
		$data2 = $this->user_model->getObjetPropreObject($id);
		
		$photo['photo']=$this->user_model->getPhotoById($idobject);
		//var_dump($photo['photo']);
		
		$array['tab'] = array($data, $data2);
		$this->load->view('Header');
		$this->load->view('AffichagePhoto', $photo);
		$this->load->view('Echange', $array);
		$this->load->view('Footer');
	}
	public function FaireEchange(){
		$this->load->model('user_model');
		$idreceveur = $this->input->post('idangatahana');
		$idobjet = $this->input->post('idphoto');
		$idobjet2 = $this->input->post('idobjet2');
		$id=$_SESSION['user']['idutilisateur'];
		$this->user_model->echange($id, $idreceveur, $idobjet, $idobjet2);
		$this->getAllObjects();
	}
	public function accepterEchange($idechange, $idobjet){
		$id = $_SESSION['user']['idutilisateur'];
        $this->load->model('user_model');
		$this->user_model->jaccepte($idechange, $idobjet, $id);
		$this->load->view('Header');
		$this->getProposition();
		$this->load->view('Footer');
    }
    public function refuserEchange($idechange){
        $this->load->model('user_model');
		$this->user_model->jerefuse($idechange);
		$this->load->view('Header');
		$this->getProposition();
		$this->load->view('Footer');
    }
}
