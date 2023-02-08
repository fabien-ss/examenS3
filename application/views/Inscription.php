<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('assets/css/login.css');?>" rel="stylesheet">
    <title>Inscription</title>
</head>
<body>
    

    <div class="login-box">
  <p>Inscription</p>
  <form action="<?php echo base_url('Connexion/newUser') ?>" method="post">
    <div class="user-box">
    <input type="text" name="nom">
      <label>Nom</label>
    </div>
    <div class="user-box">
    <input type="text" name="prenom">
      <label>prenom</label>
    </div>
    <div class="user-box">
    <input type="email" name="email">
      <label>Email</label>
    </div>
    <div class="user-box">
    <input type="number" name="numero">
      <label>Number</label>
    </div>
    <div class="user-box">
      <input required="" name="password" type="password">
      <label>Password</label>
    </div>
    <div class="user-box">
    <input  id='pass2' type="password1" name="password1">
      <label>Validation mot de passe</label>
    </div>
    <button class="btn">Valider</button>
  </form>
</div>
  
<style>

</style>

    
</body>
</html>