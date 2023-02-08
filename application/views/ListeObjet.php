<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" type="text/css">
    <title>Document</title>
</head>
<body>
<section class="products_list">
                <?php foreach($data as $d) { ?>
                    <form action="" class="product">
                    <div class="image_product">
                        <?php $path = "assets/images/".$d['nomphoto'];?>
                    <img src="<?php echo base_url($path); ?>">
                        </div>
                        <div class="content">
                            <h4 class="name"><?php echo $d['designation']; ?></h4>
                            <h2 class="price"><?php echo $d['prixestimatif']; ?></h2>
                            <a href="getObjectById/<?php echo $d['idobjet']; ?>" class="id_product">Echanger</a>
                        </div>
                    </form>
                        
                <?php } ?>
        </section>
    
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
}
body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    /* background-color: #07485d; */
}
.link {
    margin: 20px;
    width: fit-content;
    position: relative;
    text-decoration: 0;
    background-color: #605249;
    color: #fff;
    padding: 10px 25px;
    border-radius: 6px;
    font-size: 14px;
}
span {
    position: absolute;
    top: -9px;
    right: -9px;
    background-color: #f54e29;
    height: 20px;
    width: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 12px;
    color: #fff;
}
.products_list {
    margin: 100px auto;
    position: relative;
    width: 70%;
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(170px,1fr));
    grid-gap: 25px;
}
.product {
    background-color: #fefefe;
    width: 100%;
    box-shadow: 0 0 5px rgba(0,0,0,0.3);
    border-radius: 6px;
    overflow: hidden;
    transition: 0.5s;
}
.product:hover {
    transform: scale(1.1);
}
.image_product {
    height: 200px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.image_product img {
    height: 150px;
    width: 150px;
    object-fit: cover;
    padding: 20px;
}
.content {
    margin-top: 0px;
    margin-bottom: 30px;
    height: fit-content;
    text-align: center;
}
.price {
    margin: 15px 0;
    font-weight: 400;
    color: #1a5175;
}
.id_product {
    text-align: center;
    text-decoration: 0;
    background-color: #605249;
    letter-spacing: 1px;
    color: #fefefe;
    padding: 10px  10%;
    border-radius: 6px;
}

   </style>
</body>
</html>
