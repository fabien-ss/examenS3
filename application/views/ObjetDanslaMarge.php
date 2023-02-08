<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Objet dans la marge</h3>
    <?php foreach($valiny as $v) {?>
        Iobjet <?php echo $v['idobjet'] ?> <br>
        designation <?php echo $v['designation'] ?><br>
        prixestimatif <?php echo $v['prixestimatif'] ?>
        difference <?php echo $v['difference'] ?>
        <?php $id = $v['idobjet2'] ?>
        Id objet a echanger <?php echo $id ?>
        <?php $l = "LiveAction/getObjectById/".$v['idobjet']; ?>
        <a href="<?php echo base_url($l) ?>" class="id_product">Echanger</a>
        <br>
    <?php } ?>
</body>
</html>