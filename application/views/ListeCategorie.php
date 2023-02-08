<div class="body">

    <div id="first-content">
        <?php foreach($categorie as $d){ ?>
            <?php $l = 'Admin/getListeObjet/'.$d['idcategorie']; ?>
            <div id="button-group">
                <a href="<?php echo base_url($l);?>"><button><?php echo $d['nom'] ?></button></a>
            </div>
            <?php } ?>
        </div>
</div>
        

<style>
    .body{
        margin:0;
	padding: 0;
	font-family: sans-serif;
	cursor: pointer;
    }
#first-content{
	width: 500px;
	margin: 0 auto;
	margin-top:60px;
	text-align: center;
	 
}
#first-content p{
	opacity: 0.8;

}
#button-group{
	margin-top:50px;
	margin-bottom:20px;
	opacity: 1;
    display:inline;
}
#button-group button{
	border:2px #2F946D solid;
	background-color: white;
	padding:10px 15px;
	color: #2F946D;
    width:100px;
}
#button-group button:hover{
	background-color: #2F946D;
	color: white;
}
#button-group button:active{
	background-color: green;
	color: white;
}

</style>