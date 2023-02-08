<?php foreach($photo as $p){ ?>
    <?php $path = 'assets/images/'.$p['nomphoto']; ?>
<img src="<?php echo base_url($path);?>" width="20%">
    <?php } ?>