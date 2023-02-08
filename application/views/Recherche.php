<center>
<form action="<?php echo base_url('LiveAction/searchs') ?>" method="post">
    <input type="text" name="research">
    <select name="filtrage">
        <?php foreach($data as $d) { ?>
            <option value="<?php echo count($d['idcategorie']); ?>">
                <?php echo $d['nom']; ?>
            </option>
        <?php } ?>        
    </select>
    <input type="submit" value="rechercher">
</form>
</center>

