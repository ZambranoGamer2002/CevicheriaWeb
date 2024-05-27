<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PlatoModel;
use App\Models\UsuarioModel;
class Plato extends Controller{

    public function index(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request->getHeaders();
        $model = new UsuarioModel();
        $registro = $model -> where('usa_estado', 1) -> findAll();
        
        foreach($registro as $key => $value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request -> getHeader('Authorization') == 'Authorization: Basic '
                .base64_encode($value['usa_user_secreta'].':'.$value['usa_llave_secreta'])){
                    $model = new PlatoModel();
                    $plato = $model -> getPlato();
                    if(!empty($plato)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($plato),
                            "Detalles" => $plato
                        );
                    }else{
                        $data = array(
                            "Status" => 404,
                            "Total de registros" => 0,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
                }else{
                    $data = array(
                        "Status" => 404,
                        "Detalles" => "El token es incorrecto"
                    );
                }
            }else{
                $data = array(
                    "Status" => 404,
                    "Detalles" => "No posee autorización"
                );
            }    
        }
        return json_encode($data, true);

    }

    public function show($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $model = new UsuarioModel();
        $registro = $model->where('usa_estado', 1) -> findAll();
        
        foreach($registro as $key => $value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request -> getHeader('Authorization') == 'Authorization: Basic '
                .base64_encode($value['usa_user_secreta'].':'.$value['usa_llave_secreta'])){
                    $model = new PlatoModel();
                    $plato = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($plato)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $plato
                        );
                    }else{
                        $data = array(
                            "Status" => 404,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
                }else{
                    $data = array(
                        "Status" => 404,
                        "Detalles" => "El token es incorrecto"
                    );
                }
            }else{
                $data = array(
                    "Status" => 404,
                    "Detalles" => "No posee autorización"
                );
            }    
        }
        return json_encode($data, true);
    }

    
    public function create(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $model = new UsuarioModel();
        $registro = $model->where('usa_estado', 1) -> findAll();
        //var_dump($registro); die;
        foreach($registro as $key => $value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request -> getHeader('Authorization') == 'Authorization: Basic '
                .base64_encode($value['usa_user_secreta'].':'.$value['usa_llave_secreta'])){
                        $datos = array(
                            "plato_tipoplato_id" => $request -> getVar("plato_tipoplato_id"),
                            "plato_nombre" => $request -> getVar("plato_nombre"),
                            "pedido_descrip" => $request -> getVar("pedido_descrip"),
                            "plato_precio" => $request -> getVar("plato_precio"),
                            "plato_foto" => $request -> getFile("plato_foto")
                        );
                        $logo = $datos['plato_foto']; 
                        $empresa2 = intval($datos['plato_nombre']);

                        if(!empty($datos)){
                            $validation -> setRules([
                                "plato_tipoplato_id" => 'required|integer',
                                "plato_nombre" => 'required|string|max_length[100]',
                                "pedido_descrip" => 'required|string|max_length[255]',
                                "plato_precio" => 'required|integer',
                                //"prod_foto" => 'required|string|max_length[255]'
                            ]);
                            $validation -> withRequest($this -> request) -> run();
                            if($validation -> getErrors()){
                                $errors = $validation -> getErrors();
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => $errors
                                );
                                return json_encode($data, true);
                            }else{
                                $newName = $logo->getRandomName();
                                $datos = array(
                                    "plato_tipoplato_id" => $datos["plato_tipoplato_id"],
                                    "plato_nombre" => $datos["plato_nombre"],
                                    "pedido_descrip" => $datos["pedido_descrip"],
                                    "plato_precio" => $datos["plato_precio"],
                                    "plato_foto" => "https://cevicherias.informaticapp.com/public/ImagenesCevicheria/".$newName
                                );
                                $model = new PlatoModel();
                                $curso = $model -> insert($datos);
                                $data = array(
                                    "Status" => 200,
                                    "Detalles" => "Registro existoso"
                                );
                                //Subir archivo
                                $model2 = new PlatoModel;
                                //$empresa = $model2->getProducto($empresa2);
                                if($logo->isValid() && !$logo->hasMoved()) {
                                    // Directorio de destino
                                    $uploadPath = './public/ImagenesCevicheria';
                        
                                    // Generar un nombre de archivo único
                        
                                    // Mover el archivo al directorio de destino
                                    $logo->move($uploadPath, $newName);
                        
                                    // Enviar una respuesta JSON con la ubicación del archivo
                                    $response = [
                                        'status' => 'success',
                                        'message' => 'Archivo subido correctamente',
                                        'logo$logo_path' => base_url($uploadPath."/".$newName)
                                    ];
                        
                                    $up = $this->response->setJSON($response);
                                } else {
                                    // Si hay un error en la carga del archivo
                                    $response = [
                                        'status' => 'error',
                                        'message' => $logo->getErrorString()
                                    ];
                                  $up =  $this->response->setJSON($response);
                                }


                                return json_encode($data, true);
                            }
                        }else{
                            $data = array(
                                "Status" => 404,
                                "Detalles" => "Registro con errores"
                            );
                            return json_encode($data, true);
                        }
                }else{
                    $data = array(
                        "Status" => 404,
                        "Detalles" => "El token es incorrecto"
                    );
                }
            }else{
                $data = array(
                    "Status" => 404,
                    "Detalles" => "No posee autorización"
                );
            }
        }
        return json_encode($data, true);
    }



    public function update($id)
{
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();
    $headers = $request->getHeaders();
    $model = new UsuarioModel();
    $registro = $model->where('usa_estado', 1)->findAll();

    foreach ($registro as $key => $value) {
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            if ($request->getHeader('Authorization') == 'Authorization: Basic ' . base64_encode($value['usa_user_secreta'] . ':' . $value['usa_llave_secreta'])) {
                $datos = $this->request->getRawInput();

                if (!empty($datos)) {
                    $validationRules = [
                        "plato_tipoplato_id" => 'required|integer',
                        "plato_nombre" => 'required|string|max_length[100]',
                        "pedido_descrip" => 'required|string|max_length[255]',
                        "plato_precio" => 'required|integer'
                    ];

                    if (!empty($_FILES['plato_foto']['name'])) {
                        $validationRules['plato_foto'] = 'uploaded[plato_foto]|max_size[plato_foto,1024]|ext_in[plato_foto,png,jpg,jpeg]';
                    }

                    $validation->setRules($validationRules);

                    if ($validation->withRequest($this->request)->run()) {
                        $model = new PlatoModel();
                        $plato = $model->find($id);

                        if (is_null($plato)) {
                            $data = [
                                "Status" => 404,
                                "Detalles" => "Registro no existe"
                            ];
                        } else {
                            $newFileName = $plato['plato_foto'];

                            if (!empty($_FILES['plato_foto']['name'])) {
                                $newFileName = $_FILES['plato_foto']['name'];
                                $this->request->getFile('plato_foto')->move(ROOTPATH . 'public/ImagenesCevicheria', $newFileName);
                            }

                            $datos = [
                                "plato_tipoplato_id" => $request->getVar("plato_tipoplato_id"),
                                "plato_nombre" => $request->getVar("plato_nombre"),
                                "pedido_descrip" => $request->getVar("pedido_descrip"),
                                "plato_precio" => $request->getVar("plato_precio"),
                                "plato_foto" => $newFileName
                            ];

                            $model->update($id, $datos);

                            $data = [
                                "Status" => 200,
                                "Detalles" => "Datos actualizados"
                            ];
                        }
                    } else {
                        $errors = $validation->getErrors();
                        $data = [
                            "Status" => 404,
                            "Detalles" => $errors
                        ];
                    }

                    return json_encode($data, true);
                } else {
                    $data = [
                        "Status" => 400,
                        "Detalles" => "Registro con errores"
                    ];
                    return json_encode($data, true);
                }
            } else {
                $data = [
                    "Status" => 404,
                    "Detalles" => "El token es incorrecto"
                ];
            }
        } else {
            $data = [
                "Status" => 404,
                "Detalles" => "No posee autorización"
            ];
        }
    }

    return json_encode($data, true);
}

    public function delete($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $model = new UsuarioModel();
        $registro = $model->where('usa_estado', 1) -> findAll();
        
        foreach($registro as $key => $value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request -> getHeader('Authorization') == 'Authorization: Basic '
                .base64_encode($value['usa_user_secreta'].':'.$value['usa_llave_secreta'])){
                    $model = new PlatoModel();
                    $plato = $model -> where('plato_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($plato)){
                        $datos = array(
                            "plato_estado" => 0
                        );
                        $plato = $model -> update($id, $datos);
                        $data = array(
                            "Status" => 200, 
                            "Detalles" => "Se ha eliminado el registro"
                        );
                    }else{
                        $data = array(
                            "Status" => 404,
                            "Detalles" => "No hay registros"
                        );
                    }
                    return json_encode($data, true);
                }else{
                    $data = array(
                        "Status" => 404,
                        "Detalles" => "El token es incorrecto"
                    );
                }
            }else{
                $data = array(
                    "Status" => 404,
                    "Detalles" => "No posee autorización"
                );
            }    
        }
        return json_encode($data, true);
    }
}