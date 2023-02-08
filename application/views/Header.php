<div class="header">
  <a href="#default" class="logo">Takalo-Takalo</a>
  <div class="header-right">
    <a  href="<?php echo base_url('LiveAction/getAllObjects') ?>">Liste des objets</a>
    <a href="<?php echo base_url('LiveAction/getmesobjets') ?>">Mes objets</a>
    <a href="<?php echo base_url('LiveAction/getProposition') ?>">Propositioms</a>
    <a href="<?php echo base_url('LiveAction/InsererObjet') ?>">Inserer Objet</a>
    <a href="<?php echo base_url('LiveAction/recherche') ?>">Recherche</a>
    <a href="<?php echo base_url('LiveAction/Historique') ?>">Historique</a>
    <a href="<?php echo base_url('Connexion/disconnect') ?>">Deconnexion</a>
  </div>
</div>
<style>
    * {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: #f1f1f1;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: black;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
  background-color: #ddd;
  color: black;
}

.header a.active {
  background-color: dodgerblue;
  color: white;
}

.header-right {
  float: right;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .header-right {
    float: none;
  }
}

</style>