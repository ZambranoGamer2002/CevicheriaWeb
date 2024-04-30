<?php

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => 'https://cevicherias.informaticapp.com/sucursal',
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => '',
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 0,
CURLOPT_FOLLOWLOCATION => true,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => 'GET',
CURLOPT_HTTPHEADER => array(
    'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VWYVRVZXpBOFQuSEYza25WTjZLUTVMSzBSc1Nwc0tPOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlSGdrN1Q1dWswNGhrWFN1MG9GYmdBZFZ3dkxSbWt2dQ=='
),
));

$response = curl_exec($curl);

curl_close($curl);
$data = json_decode($response, true);


session_start();
$curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://cevicherias.informaticapp.com/platos',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic YTJhYTA3YWRmaGRmcmV4ZmhnZGZoZGZlcnR0Z2VWYVRVZXpBOFQuSEYza25WTjZLUTVMSzBSc1Nwc0tPOm8yYW8wN29kZmhkZnJleGZoZ2RmaGRmZXJ0dGdlSGdrN1Q1dWswNGhrWFN1MG9GYmdBZFZ3dkxSbWt2dQ=='
      ),
    ));

 $response = curl_exec($curl);

 curl_close($curl);
 $data2 = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>


<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">


</head>
<body>



<style>
.container_card{    margin: 0 auto;    padding:  0px 20px 20px 20px;    display: grid;    /* width: 800px; */    grid-template-columns: 1fr 1fr ;   grid-gap:1em;        /* grid-row-gap: 60px; */}
.blog-post{    position: relative;    margin-bottom: 15px;    margin: 30px;}
.blog-post img{    width: 100%;    height: 450px;    object-fit: cover;    border-radius: 10px;    }
.blog-post .category{    position: absolute;    top: 20px;    left: 20px;    padding: 10px 15px;  font-size: 14px;    text-decoration: none;    background-color: #e67e22;    color: #fff;    border-radius: 5px;    box-shadow: 1px 1px 8px rgba(0,0,0,0.1);    text-transform: uppercase;}
.text-content{    position: absolute;    bottom: -30px;    padding: 20px;    background-color: #fff;    width: calc(100% - 20px);    left: 50%;    transform: translateX(-50%);    border-radius: 10px;    box-shadow: 1px 1px 8px rgba(0,0,0,0.08);/* padding-top: 50px; */}
.text-content h2{    font-size: 20px;    font-weight: 400;    /* margin-bottom: 30px; */}
.text-content img{    height: 70px;    width: 70px;    border: 5px solid rgba(0,0,0,0.1);    border-radius: 50%;    position: absolute;    top: -35px;    left: 35px;}
.tags a{    color: #888;    font-weight: 700;    text-decoration: none;    margin-right: 15px;    transition: 0.3s ease;}
.tags a:hover{    color: #000;}
@media screen and (max-width: 1100px) {    .container_card{        grid-template-columns: 1fr 1fr;        grid-row-gap: 60px;    }}
@media screen and (max-width: 600px) {    .container_card{        grid-template-columns: 1fr;        grid-row-gap: 60px;    }}
</style>


<!-- NAVBAR -->
<?php 

include("nav_cart.php"); 
include("modal_cart.php");

?>

<!-- vista A -->
<div class="center mt-5">

            
            <div class="container_card">
              
            <?php foreach($data2["Detalles"] as $plato): ?>
                
                    <form id="formulario" name="formulario" method="post" action="cart.php">
                        <div class="blog-post ">
                            <img src="image/ceviche_clasico.png" >
                                <div class="text-content">
                                    
                                    <input name="pla_precio" type="hidden" id="pla_precio" value="<?php echo $plato["pla_precio"]; ?>" />
                                    <input name="pla_comida" type="hidden" id="pla_comida" value="<?php echo $plato["pla_comida"]; ?>" />
                                    <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />
                                        <div class="card-body">
                                                S/. <?php echo $plato["pla_precio"]; ?>
                                                <h5 class="card-title"><?php echo $plato["pla_comida"]; ?></h5>
                                                <p><?php echo $plato["pla_descrip"]; ?></p>
                                                <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                                        </div>
                                </div>
                        </div>
                    </form>

                    <?php endforeach ?>
            </div>
        </div>
    </div>
                
</div>
<!-- END vista A -->











<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" ></script>

</body>
</html>




