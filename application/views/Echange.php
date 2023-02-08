<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo base_url('/LiveAction/FaireEchange'); ?>" method="post">
    
    <?php echo $tab[0][0]['designation']; ?>
    <?php echo $tab[0][0]['prixestimatif']; ?>
    <input type="hidden" name="idangatahana" value="<?php echo $tab[0][0]['idutilisateur']; ?>">
    <input type="hidden" name="idobjet2" value="<?php echo $tab[0][0]['idobjet']; ?>">
    <select name="idphoto"> 
        <!-- idphoto a echanger -->
        <?php for($i=0; $i<count($tab[1]);$i++) { ?>
            <option value="<?php echo $tab[1][$i]['idobjet']; ?>">
                <?php echo $tab[1][$i]['designation']; ?>
            </option>
        <?php } ?>        
    </select>
    <input type="submit" value="DEMANDE D'ECHANGE">
    </form>
</body>
<style>
  
</style>
</html>