<style>
.panier {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin-top:-100px;
}
.panier img {
    width: 80px;
    padding: 8px 0;
}
.panier section {
    width: 70%;
    background-color: #fefefe;
    padding: 10px;
    border-radius: 6px;
}
table {
    border-collapse: collapse;
    width: 100%;
    letter-spacing: 1px;
    font-size: 13px;
}
th {
    padding: 10px 0;
    font-weight: 400;
}
td {
    border-top: 0.5px solid #999;
    text-align: center;
    color: #1a5175;
}
tr {
    border-bottom: 0.5px solid #999;
}
</style>
<div class="panier">
<section>
        <table>
            <tr>
                <th></th>
                <th>idobjet</th>
                <th>nom</th>
                <th>estimation</th>
            </tr>
            
            <?php
                foreach ($objets as $o) { ?>
                <?php $path = 'assets/images/'.$o['nomphoto']; ?>
                <tr>
                    <td><img src="<?php echo base_url($path);?>"></td>
                    <td><?php echo $o['idobjet'];?></td>
                    <td><?php echo $o['designation'];?></td>
                    <td><?php echo $o['prixestimatif'];?>Ar</td>
                </tr>
                <?php } ?>
        </table>
    </section>
    </div>