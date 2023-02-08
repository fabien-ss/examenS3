<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userrequest_model extends CI_Model {
    public function checkPassword($password, $password1){
        if(count($password) < 1){
            throw new Exception("Password too short");
        }
        if($password != $password1){
            throw new Exception("You should type the same password");
        }
        return true;
    }
    public function insertNewUser($nom, $email, $numero, $password, $prenom){
        $sql = "INSERT INTO utilisateur (nom, email, numero, motdepasse, prenom) values ('$nom','$email','$numero','$password','$prenom')";
        $this->db->query($sql);
    }
}
