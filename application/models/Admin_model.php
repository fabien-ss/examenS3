<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    //STATISTIQUE DEBUT
    public function countEchange(){
        $sql = "select count(idechange) nb from echange where etat = 1";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
    }
    public function getNombreDutilisateur(){
        $sql = "select count(idutilisateur) nb from utilisateur where estadmin != 10";
        $query = $this->db->query($sql);
		$row = $query->row_array();
		return $row;
    }
    //STATISTIQUE FIN


    public function getCategorie(){
        $query = $this->db->query("select idcategorie, nom from categorie");
        $data = array();
        $i = 0;
        foreach($query->result_array() as $row){
            $data[$i]['idcategorie'] = $row['idcategorie'];
            $data[$i]['nom'] = $row['nom'];
            $i++;
        }
        return $data;
    }
    public function getObjetByCategorie($id){
        $sql1 = "select objet.*,photo.idphoto,photo.nomphoto from objet join photo on objet.idobjet=photo.idobjet where objet.idcategorie='$id'";
        $sql = "select idobjet, designation, prixestimatif, nomphoto from v_objet_objet where idcategorie='$id'";
        $query = $this->db->query($sql1);
        $data = array();
        $i = 0;
        
        foreach($query->result_array() as $row){
            $data[$i]['idobjet'] = $row['idobjet'];
            $data[$i]['designation'] = $row['designation'];
            $data[$i]['prixestimatif'] = $row['prixestimatif'];
            $data[$i]['nomphoto'] = $row['nomphoto'];
            $i++;
        }
        return $data;    
    }
}
