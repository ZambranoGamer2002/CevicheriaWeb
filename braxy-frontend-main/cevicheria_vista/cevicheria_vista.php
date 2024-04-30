<?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://cevicherias.informaticapp.com/sucursal/'.$_GET['sucu_id'],
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
    $platos = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data["Detalle"][0]['sucu_nombre'] ?></title>
    <link rel="stylesheet" href="css/styleCevicheriaVista.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<!-- DISEÑO SUPERIOR, CARRITO -->
<body>

    <header class="header">

        <img class="bg" src="image/bg.png" alt="">
        <div class="menu container">
            <a href="" class="logo"><?= $data["Detalle"][0]['sucu_nombre'] ?></a>
            <input type="checkbox" id="menu">
            <label for="menu">
                <img src="image/menu.png" class="menu-icono" alt="">

            </label>
            <nav class="navbar">
            <?php 
                include("nav_cart.php"); 
                include("modal_cart.php");
            ?>
                <ul>
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#carta">Carta</a></li>
                    <li><a href="#platos">Platos</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="login.html">Login/Register</a></li>
                    


                </ul>
            </nav>
            
            <div> 
                <ul>
                    <li class="submenu">
                        <img src="image/car.png" id="img-carrito" alt="carrito">
                        <div id="carrito">
                            <table id="lista-carrito">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <a href="#" id="vaciar-carrito" class="btn-3">Vaciar Carrito</a>
                            <a href="platos_editar_html.php?pla_id=<?= $plato['pla_id'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <h1>Bienvenido disfruta de nuestros ricos platillos Marinos</h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Consequatur repellat maxime a soluta,
                    fugiat recusandae ab rerum cumque fuga. 
                    Tenetur magni voluptatibus labore sunt similique? Aspernatur
                    reprehenderit molestiae beatae ex!
                </p>
            </div>
            <div class="header-img">
                <img src="image/pl-1.png" alt="">
            </div>
        </div>
    </header>
    <!-- PLATILLOS-->
    <section class="breakfast container">

        <h2>Carta del día</h2>
        <p>
            Horario 9 a.m. - 8 p.m.
        </p>
    <div class="breakfast-content" id="carta">

        <div class="breakfast-1" id="cevichesnav">
            <img src="image/ceviche_clasico.png" alt="">
            <a href="#lista-1" class="btn-cv">Ceviches</a>
        </div>
        <div class="breakfast-1" id="combosnav">
            <img src="image/ceviche_clasico.png" alt="">
            <a href="#lista-2" class="btn-cb">Combos</a>
        </div>
        <div class="breakfast-1" id="menusnav">
            <img src="image/ceviche_clasico.png" alt="">
            <a href="#lista-3" class="btn-dy">Menu</a>
        </div>
        <div class="breakfast-1" id="bebidasnav">
            <img src="image/ceviche_clasico.png" alt="">
            <a href="#lista-4" class="btn-bb">Bebidas</a>
        </div>
    </div>
    </section>

    <section class="info">

        <img class="bg-2" src="image/bg-2.png" alt="">
        <div class="info-content container" id="carta">
            <div class="info-img">
                <img src="image/breakfast.png" alt="">
            </div>

                <div class= "info-txt">

                
                <h2>Los mejores platillos Marinos Peruanos</h2>
                <p> 
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                    Recusandae velit sequi vero aliquam quis neque consectetur, 
                    animi, ratione sint ea omnis, illo exercitationem cumque nulla
                    quod voluptas fugiat nihil ex.
                </p>
                <a href="#" class="btn-1">Informacion</a>
            </div>

        </div>

    </section>

    <!-- APARTADO DE CEVICHES -->

    <main class="ceviches container">

        <h2>Ceviches</h2>

        <div class="box-container" id="lista-1">

        <?php foreach($platos["Detalles"] as $Platos):?>
        <?php if ($Platos["tico_nombre"] == "Plato de comida"): ?>
            <div class="box">
                <img src="image/plato1.png">
                <div class="">
                    <input name="pla_precio" type="hidden" id="pla_precio" value="<?php echo $plato["pla_precio"]; ?>" />
                    <input name="pla_comida" type="hidden" id="pla_comida" value="<?php echo $plato["pla_comida"]; ?>" />
                    <h3><?= $Platos["pla_comida"] ?></h3>
                    <p class="precio"> S/. <?= $Platos["pla_precio"] ?></p>
                    <button class="btn btn-primary" type="submit" ><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
                </div>

            </div>
        <?php endif; ?>
        <?php endforeach ?>

        </div>

        <div class="btn-pcv" id="load-more"> Cargar Mas</div>

    </main>

    <!-- FIN DE APARTADO DE CEVICHES -->

    <!-- APARTADO DE COMBOS -->

    <main class="combos container">

        <h2>Combos</h2>

        <div class="box-container-2" id="lista-2" id="combosnav">

            <div class="box-2">
                <img src="image/plato9.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="9">Agregar al carrito</a>
                </div>

            </div>
            <div class="box-2">
                <img src="image/plato10.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="10">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato11.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="11">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato12.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="12">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato13.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="13">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato14.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="14">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato15.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="15">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-2">
                <img src="image/plato16.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="16">Agregar al carrito</a>
                </div>
            </div>

        </div>

        <div class="btn-pcb" id="load-more-2"> Cargar Mas</div>

    </main>

    <!-- FIN DE APARTADO DE COMBOS -->

    <!-- APARTADO DE MENUS -->

    <main class="menus container">

            <h2>Menus</h2>
    
            <div class="box-container-3" id="lista-3">
    
                <div class="box-3">
                    <img src="image/plato17.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="17">Agregar al carrito</a>
                    </div>
    
                </div>
                <div class="box-3">
                    <img src="image/plato18.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="18">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato19.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="19">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato20.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="20">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato21.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="21">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato22.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="22">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato23.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="23">Agregar al carrito</a>
                    </div>
                </div>
    
                <div class="box-3">
                    <img src="image/plato24.png" alt="">
                    <div class="">
                        <h3>Elisyum</h3>
                        <p>Calidad de preparación</p>
                        <p class="precio">s/.30</p>
                        <a href="#" class="agregar-carrito btn-3" data-id="24">Agregar al carrito</a>
                    </div>
                </div>
    
            </div>
    
            <div class="btn-pm" id="load-more-3">Cargar Mas</div>
    
     </main>

    <!-- FIN DE APARTADO DE MENUS -->

    <!-- APARTADO DE BEBIDAS -->

    <main class="bebidas container">

        <h2>Bebidas</h2>

        <div class="box-container-4" id="lista-4">

            <div class="box-4">
                <img src="image/bebida1.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="25">Agregar al carrito</a>
                </div>

            </div>
            <div class="box-4">
                <img src="image/bebida2.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="26">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida3.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="27">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida8.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="28">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida5.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="29">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida6.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="30">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida4.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="31">Agregar al carrito</a>
                </div>
            </div>

            <div class="box-4">
                <img src="image/bebida7.png" alt="">
                <div class="">
                    <h3>Elisyum</h3>
                    <p>Calidad de preparación</p>
                    <p class="precio">s/.30</p>
                    <a href="#" class="agregar-carrito btn-3" data-id="32">Agregar al carrito</a>
                </div>
            </div>

        </div>

        <div class="btn-pbb" id="load-more-4">Cargar Mas</div>

 </main>

<!-- FIN DE APARTADO DE MENUS -->
    

    <!-- APARTADOS DE APP -->
<section class="app container">

    <div class="app-txt" id="contacto">
            <h2>Descarga nuestra app y descubre ofertas</h2>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum laborum nesciunt labore autem, id doloribus doloremque enim 
                maiores! Saepe facere possimus exercitationem, quisquam quos placeat 
                inventore sit et doloribus fugit
            </p>
        <div class="descarga">
                <img src="image/store1.png" alt="">
                <img src="image/store2.png" alt="">
        </div>

    </div>

        <div class="app-img">
            <img src="image/app.png" alt=""> 
        </div>
</section>

<!-- FOOTER -->

<footer class="footer">

    <div class="footer-content container">

        <div class="link">
            <h3>Lorem</h3>
            <ul>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
            </ul>
        </div>

        <div class="link">
            <h3>Lorem</h3>
            <ul>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
            </ul>
        </div>

        <div class="link">
            <h3>Lorem</h3>
            <ul>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
                <li><a href="#">Lorem</a></li>
            </ul>
        </div>

        <div class="link">
            <h3>Lorem</h3>
            <div class="descarga">
                <img src="image/store1.png" alt="">
                <img src="image/store2.png" alt="">
            </div>
        </div>
        
    </div>
</footer>


    <script src="js/scriptCevicheriaVista.js"></script>
</body>

</html>