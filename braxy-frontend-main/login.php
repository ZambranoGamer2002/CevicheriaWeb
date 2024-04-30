<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_start();
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://cevicherias.informaticapp.com/usuarios/'.$_POST['usu_usuario'].'&'.$_POST['usu_clave'],
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

        $usuario = $_POST['usu_usuario'];
        $clave = $_POST['usu_clave'];
        
        if($data["Status"] == "404"){
            //header("Location: cevicherias_vista.php");
        }else if($data['Detalles']['0']['usu_usuario'] == $usuario && $data['Detalles']['0']['usu_clave'] == $clave){
            //header('Location: admin.php?sucu_id='.$data['Detalles']['0']['sucu_id']);
            header('Location: admin.php');
            $valorGlobal = $data['Detalles'];
            
            // Almacena el valor en una variable de sesión para hacerla global
            $_SESSION['mi_variable_global'] = $valorGlobal;
        }
	}
    /*else{
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
        $sucursal = json_decode($response, true);
    }*/
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" color="white">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Acceso</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usu_usuario" name="usu_usuario" type="text" placeholder="Usuario" />
                                                <label for="inputEmail">Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usu_clave" name="usu_clave" type="password" placeholder="Clave" />
                                                <label for="inputPassword">Clave</label>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-secondary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
