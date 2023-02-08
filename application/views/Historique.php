<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($data as $d) { ?>
        <?php echo $d['idobjet']; ?>
        <?php echo $d['designation'];?>
        <?php echo $d['nom'];?>
        <?php echo $d['prenom'];?>
        <?php echo $d['dateappartenance'];?>
        <?php echo $d['idutilisateur'];?>
        <br>
    <?php } ?>
</body>
</html>