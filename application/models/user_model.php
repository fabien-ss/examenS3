<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class user_model extends CI_Model {
        public function getMarge($data, $marge){
            $prix = (float) $data['data']['prixestimatif'];
            $m = (float) $marge;
            $moins = ((float)$m*$prix)/100;
            $min = $prix-$moins;
            $max = $prix+$moins;
            
            return array($min, $max);
        }
        public function getObjetInRange($range, $objet){
            $min = $range[0][0];
            $max = $range[0][1];
            $id = $objet['data']['idobjet'];
            $idU = $objet['data']['idutilisateur'];
            $sql = "select * from objet where prixestimatif>'$min' and prixestimatif<'$max' and idobjet!='$id' and idutilisateur!='$idU'";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['idcategorie'] = $row['idcategorie'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['difference'] = (float)$objet['data']['prixestimatif']- (float)$row['prixestimatif'];
                $data[$i]['idobjet2'] = $objet['data']['idobjet'];
                $i++;
            }
            return $data;
        }

        public function getObjetByIdObjet($id){
            $query = $this->db->query("select * from objet where idobjet='$id'");
            $row = $query->row_array();
		    return $row; 
        }
//3
        public function getHistorique(){
            $sql = "SELECT h.idobjet, o.designation , h.idutilisateur, u.nom, u.prenom, h.dateAppartenance FROM HISTORIQUE h JOIN utilisateur u ON h.idutilisateur = u.idutilisateur JOIN objet o ON o.idobjet = h.idobjet";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['nom'] = $row['nom'];
                $data[$i]['prenom'] = $row['prenom'];
                $data[$i]['dateappartenance'] = $row['dateAppartenance'];
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $i++;
            }
            return $data;            
        }
        public function historiser($idObjet, $idUtilisateur){
            $sql = "INSERT INTO HISTORIQUE(idobjet, idutilisateur,dateappartenance) values ('$idObjet','$idUtilisateur',NOW())";
            $this->db->query($sql);
        }

        public function recherche($motcle,$idfiltre){
            $id = $_SESSION['user']['idutilisateur'];
            $query = $this->db->query("select * from objet where designation like '%$motcle%' and idcategorie='$idfiltre' and idutilisateur!='$id'");
            $data = array();
            $i=0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet'] = $row['idobjet'];                
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['idcategorie'] = $row['idcategorie'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $i++;
            }
            return $data;
        }
        public function upload_action($_FILES) {
            $file_count = count($_FILES['files']['name']);
            $img_string = "";
            for ($i = 0; $i < $file_count; $i++) {
                $filename = $_FILES['files']['name'][$i];
                //echo $filename;
                if (in_array(strchr($filename, "."), array('.png', '.jpg', '.jpeg', '.PNG', '.JPG', '.JPEG'))) {
                  //  echo $_FILES['files']['tmp_name'][$i];
                    move_uploaded_file($_FILES['files']['tmp_name'][$i], ('assets/images/'.$filename));
                    $img_string .= $filename;
                    if ($i < $file_count - 1) {
                        $img_string .= ",";
                    }
                }
            }
        }

        public function getAllCategorie(){
            $sql = "select * from categorie";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idcategorie'] = $row['idcategorie'];
                $data[$i]['nom'] = $row['nom'];
                $i++;
            }
            return $data;
        }
        public function insertPhoto($files){
            $this->upload_action($files);
            $sql = "Select * from objet where idobjet= (select max(idobjet) from objet)";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            foreach($files as $f){
                $idobjet = $row['idobjet'];
                $str = $f['name'];
                $sql = "INSERT INTO photo(idobjet, nomphoto) values('$idobjet', '$str[0]') ";
                $this->db->query($sql);      
            }
        }
        public function insertion($nom, $estimation, $categorie, $idutilisateur, $files){
            $sql = "INSERT INTO objet(designation,prixestimatif, idutilisateur, idcategorie) values('$nom','$estimation', $idutilisateur, $categorie) ";
            $this->db->query($sql);
            $this->insertPhoto($files);
        }
        public function getEchange($idechange){
            $sql = "Select * from echange where idechange='$idechange'";
            $query = $this->db->query($sql);
            $row = $query->row_array();
            return $row;
        }
        public function jaccepte($idechange, $idobjet, $idutilisateur){
            //1 izy accepte
            $echange = $this->getEchange($idechange);

            $sql = "update echange set etat = 1,dateacceptation=NOW() where idechange='$idechange'";
            $this->db->query($sql);
            $idobjet = $echange['idobjet'];
            $idobjet2 = $echange['idobjet2'];
            $idUser1 = $echange['iddemande'];
            $idUser2 = $echange['idreceveur'];
            
            $updateProprietaire = "update objet set idutilisateur='$idUser2' where idobjet='$idobjet'";
            $this->db->query($updateProprietaire);
            $this->historiser($idobjet, $idUser2);
            $updateProprietaire2 = "update objet set idutilisateur='$idUser1' where idobjet='$idobjet2'";
            $this->db->query($updateProprietaire2);
            $this->historiser($idobjet2, $idUser1);
        }
        public function jerefuse($idechange){
            //2 izy tsy accepte
            $sql = "update echange set etat = 2 where idechange='$idechange'";
            $this->db->query($sql);
        }
        public function getObjectPropose($id){
            $sql = "SELECT e.idobjet2, o1.designation designation2 ,e.idechange , e.idreceveur,e.iddemande as idutilisateur, e.etat, e.dateechange, u.nom, u.prenom, e.idobjet, o.designation, o.prixestimatif, p.nomphoto FROM echange e JOIN objet o ON o.idobjet = e.idobjet JOIN objet o1 ON o1.idObjet = e.idobjet2 JOIN utilisateur u ON u.idUtilisateur = e.iddemande JOIN photo p ON p.idobjet = e.idobjet where e.idreceveur='$id' and etat=0 group by idobjet";
            $sql2 = "select * from v_Demande2 where idreceveur = '$id' and etat = 0 group by idobjet";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet2'] = $row['idobjet2'];
                $data[$i]['designation2'] = $row['designation2'];
                $data[$i]['idechange'] = $row['idechange'];
                $data[$i]['etat'] = $row['etat'];
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['nom'] = $row['nom'];
                $data[$i]['prenom'] = $row['prenom'];
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['nomphoto'] = $row['nomphoto'];
                $i++;
            }
            return $data;
        }

        public function getObjectById($id){
            $sql =" SELECT utilisateur.idutilisateur,utilisateur.prenom,categorie.nom,objet.idobjet,objet.designation,objet.prixestimatif,photo.nomphoto FROM objet JOIN utilisateur ON objet.idutilisateur=utilisateur.idutilisateur JOIN categorie ON objet.idcategorie=categorie.idcategorie JOIN photo ON objet.idobjet=photo.idobjet where objet.idobjet!='$id'";
            $sql2 = "select idutilisateur,designation, idobjet, prenom, nom, prixestimatif, nomphoto from v_objet where idobjet!='$id'";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['prenom'] = $row['prenom'];
                $data[$i]['nom'] = $row['nom'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['nomphoto'] = $row['nomphoto'];
                $i++;
            }
            return $data;
        }
        public function getPhotoById($id){
            $sql = "select * from photo where idobjet='$id'";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idphoto'] = $row['idphoto'];
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['nomphoto'] = $row['nomphoto'];
                $i++;
            }
		    return $data;
        }
        public function getObjetPropreObject($id){
            $query = $this->db->query("select idobjet, designation, prixestimatif, idcategorie from objet where idutilisateur='$id'");
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['idcategorie'] = $row['idcategorie'];
                $i++;
            }
		    return $data;
        }
        public function echange($idDemande, $idReceveur, $idobjet, $idobjet2){
            $sql = "INSERT INTO echange (iddemande, idreceveur, idobjet, idobjet2, dateechange) values ('$idDemande', '$idReceveur', '$idobjet','$idobjet2',Now())";
            $this->db->query($sql);
        }  
        public function getAllObject($id){
            $sql =" SELECT utilisateur.idutilisateur,utilisateur.prenom,categorie.nom,objet.idobjet,objet.designation,objet.prixestimatif,photo.nomphoto FROM objet JOIN utilisateur ON objet.idutilisateur=utilisateur.idutilisateur JOIN categorie ON objet.idcategorie=categorie.idcategorie JOIN photo ON objet.idobjet=photo.idobjet where utilisateur.idutilisateur!='$id' group by objet.idobjet";
            $sql2 ="select idutilisateur,designation, idobjet, prenom, nom, prixestimatif, nomphoto from v_objet where idutilisateur!='$id' group by idobjet";
            $query = $this->db->query($sql);
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['prenom'] = $row['prenom'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['nom'] = $row['nom'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['nomphoto'] = $row['nomphoto'];
                $i++;
            }
            return $data;
        }

        public function getObject($id){
            $query = $this->db->query("select * from objet where idobjet ='$id'");
            $data = array();
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['idcategorie'] = $row['idcategorie'];
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $i++;
            }
            return $data;
        }


        public function getMesObject($id){
            $sql =" SELECT utilisateur.idutilisateur,utilisateur.prenom,categorie.nom,objet.idobjet,objet.designation,objet.prixestimatif,photo.nomphoto FROM objet JOIN utilisateur ON objet.idutilisateur=utilisateur.idutilisateur JOIN categorie ON objet.idcategorie=categorie.idcategorie JOIN photo ON objet.idobjet=photo.idobjet where utilisateur.idutilisateur='$id' group by objet.idobjet";
            $sql2 = "select idutilisateur,designation, idobjet, prenom, nom, prixestimatif, nomphoto from v_objet where idutilisateur='$id' group by idobjet";
            $query = $this->db->query($sql);
            $data = array();
            $stringy = "select idutilisateur,designation, idobjet, prenom, nom, prixestimatif, nomphoto from v_objet where idutilisateur='$id'";
            $i = 0;
            foreach($query->result_array() as $row){
                $data[$i]['idutilisateur'] = $row['idutilisateur'];
                $data[$i]['idobjet'] = $row['idobjet'];
                $data[$i]['prenom'] = $row['prenom'];
                $data[$i]['designation'] = $row['designation'];
                $data[$i]['nom'] = $row['nom'];
                $data[$i]['prixestimatif'] = $row['prixestimatif'];
                $data[$i]['nomphoto'] = $row['nomphoto'];
                $i++;
            }
            return $data;
        }
    }
?>