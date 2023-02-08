<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url('assets/css/login.css');?>" rel="stylesheet">
    <title>Document</title>
</head>
    <script>
        
    </script>
<body>
<div class="login-box">
           
                <form action="<?php echo base_url("Connexion/login") ?>" method="post">
                    <div class="user-box">
                            <input required="" name="email" type="email/number" value="kanty@gmail.com">
                            <label>Email</label>
                    </div>
                    <div class="user-box">
                        <input required="" name="password" type="password" value="1234">
                        <label>Password</label>
                    </div>
                    <button class="btn">Valider</button>
                    
                </form>
                <p>Don't have an account? <a href="<?php echo base_url("Connexion/inscription") ?>" class="a2">Inscription</a></p>
            
</div>
   
</body>
</html>