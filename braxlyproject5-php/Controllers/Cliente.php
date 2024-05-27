<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ClienteModel;
use App\Models\UsuarioModel;
class Cliente extends Controller{

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
                    $model = new ClienteModel();
                    $cliente = $model -> getCliente();
                    if(!empty($cliente)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($cliente),
                            "Detalles" => $cliente
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
                    $model = new ClienteModel();
                    $cliente = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($cliente)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $cliente
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
                            "clien_usua_id" => $request -> getVar("clien_usua_id"),
                            "clien_nombres" => $request -> getVar("clien_nombres"),
                            "clien_apellidos" => $request -> getVar("clien_apellidos"),
                            "clien_foto" => $request -> getVar("clien_foto"),
                            "clien_dni" => $request -> getVar("clien_dni"),
                            "clie_correo" => $request -> getVar("clie_correo"),
                            "clien_celular" => $request -> getVar("clien_celular"),
                            "clien_genero" => $request -> getVar("clien_genero")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "clien_usua_id" => 'required|integer',
                                "clien_nombres" => 'required|string|max_length[100]',
                                "clien_apellidos" => 'required|string|max_length[100]',
                                "clien_foto" => 'required|string|max_length[255]',
                                "clien_dni" => 'required|integer',
                                "clie_correo" => 'required|string|max_length[100]',
                                "clien_celular" => 'required|string|max_length[100]',
                                "clien_genero" => 'required|string|max_length[100]'
                                
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
                                $datos = array(
                                    "clien_usua_id" => $datos["clien_usua_id"],
                                    "clien_nombres" => $datos["clien_nombres"],
                                    "clien_apellidos" => $datos["clien_apellidos"],
                                    "clien_foto" => $datos["clien_foto"],
                                    "clien_dni" => $datos["clien_dni"],
                                    "clie_correo" => $datos["clie_correo"],
                                    "clien_celular" => $datos["clien_celular"],
                                    "clien_genero" => $datos["clien_genero"]

                                );
                                $model = new ClienteModel();
                                $curso = $model -> insert($datos);
                                $data = array(
                                    "Status" => 200,
                                    "Detalles" => "Registro existoso"
                                );
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

    public function update($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $model = new UsuarioModel();
        $registro = $model->where('usa_estado', 1) -> findAll();
        foreach($registro as $key => $value){
            if(array_key_exists('Authorization',$headers)&& !empty($headers['Authorization'])){
                if($request -> getHeader('Authorization') == 'Authorization: Basic '
                .base64_encode($value['usa_user_secreta'].':'.$value['usa_llave_secreta'])){
                    $datos = $this -> request -> getRawInput();
                    if(!empty($datos)){
                        $validation -> setRules([
                                "clien_usua_id" => 'required|integer',
                                "clien_nombres" => 'required|string|max_length[100]',
                                "clien_apellidos" => 'required|string|max_length[100]',
                                "clien_foto" => 'required|string|max_length[255]',
                                "clien_dni" => 'required|integer',
                                "clie_correo" => 'required|string|max_length[100]',
                                "clien_celular" => 'required|string|max_length[100]',
                                "clien_genero" => 'required|string|max_length[100]'
                                
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
                            $model = new ClienteModel();
                            $cliente = $model -> find($id);
                            if(is_null($cliente)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "clien_usua_id" => $datos["clien_usua_id"],
                                    "clien_nombres" => $datos["clien_nombres"],
                                    "clien_apellidos" => $datos["clien_apellidos"],
                                    "clien_foto" => $datos["clien_foto"],
                                    "clien_dni" => $datos["clien_dni"],
                                    "clie_correo" => $datos["clie_correo"],
                                    "clien_celular" => $datos["clien_celular"],
                                    "clien_genero" => $datos["clien_celular"]
                                    
                                );
                                $model = new ClienteModel();
                                $cliente = $model -> update($id, $datos);
                                $data = array(
                                    "Status" => 200,
                                    "Detalles" => "Datos actualizados"
                                );
                                return json_encode($data, true);
                            }
                        }
                    }else{
                        $data = array(
                            "Status" => 400,
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
                    $model = new ClienteModel();
                    $cliente = $model -> where('clien_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($cliente)){
                        $datos = array(
                            "clien_estado" => 0
                        );
                        $cliente = $model -> update($id, $datos);
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