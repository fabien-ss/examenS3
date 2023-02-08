




    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
    
<center>
    <br>
<table border="1" class='table'>
<thead class="bill-header cs">
                    <tr>
                        <th id="trs-hd-1" class="col-lg-1">Votre objet</th>
                        <th id="trs-hd-7" class="col-lg-1">Nom</th>
                        <th id="trs-hd-2" class="col-lg-2">Prenom</th>
                        <th id="trs-hd-3" class="col-lg-3">Objet a echanger</th>
                        <th id="trs-hd-4" class="col-lg-2">Prix</th>
                        <th id="trs-hd-6" class="col-lg-2">Photo</th>
                        <th id="trs-hd-6" class="col-lg-2">Action</th>
                        
                    </tr>
                </thead>
    <?php foreach($data as $d){ ?>
        <tr>
       <td>Votre objet <?php echo $d['designation2'];?></td>
        <td><?php echo $d['nom'];?></td>
        <td><?php echo $d['prenom'];?></td>
        <td>Demande d'echange avec <?php echo $d['designation'];?></td>
        <td>Valeur <?php echo $d['prixestimatif'];?>
        </td>
        <?php $path = "assets/images/".$d['nomphoto']; ?>
        <td><img src="<?php echo base_url($path); ?>" width="100%"></td>
        <?php $str = 'LiveAction/accepterEchange/'.$d['idechange'].'/'.$d['idobjet']; ?>
        <td><a class="btn btn-success" style="margin-left: 5px;"href="<?php echo base_url($str); ?>">D'accord</a></td>
        <?php $str2 = 'LiveAction/refuserEchange/'.$d['idechange']; ?>
        <td><a class="btn btn-danger" style="margin-left: 5px;"  href='<?php echo base_url($str2); ?>'>Je reufuse</a></td>
    </tr>
    <?php } ?>
    </table>
    <style>
        td{
            width:10%;
        }
    </style>
    </center>

