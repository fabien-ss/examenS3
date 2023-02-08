<?php   foreach($data as $d) {?>
    <br>
    <div class="container">
        <?php echo $d['idobjet'];?>                
        <?php echo $d['idutilisateur'];?>
        <?php echo $d['idcategorie'];?>
        <?php echo $d['designation'];?>
        <?php echo $d['prixestimatif'];?>
        <a href="getObjectById/<?php echo $d['idobjet']; ?>">Echanger</a>
    </div>
    <br>
<?php } ?>
