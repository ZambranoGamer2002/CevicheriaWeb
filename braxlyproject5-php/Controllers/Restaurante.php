<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RestauranteModel;
use App\Models\UsuarioModel;
class Restaurante extends Controller{

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
                    $model = new RestauranteModel();
                    $restaurante = $model -> getRestaurante();
                    if(!empty($restaurante)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($restaurante),
                            "Detalles" => $restaurante
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
                    $model = new RestauranteModel();
                    $restaurante = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($restaurante)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $restaurante
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
                            "restaurant_usua_id" => $request -> getVar("restaurant_usua_id"),
                            "restaurant_descripcion" => $request -> getVar("restaurant_descripcion"),
                            "restaurant_direccion" => $request -> getVar("restaurant_direccion"),
                            "restaurant_telefono" => $request -> getVar("restaurant_telefono"),
                            "restaurant_horario" => $request -> getVar("restaurant_horario")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "restaurant_usua_id" => 'required|integer',
                                "restaurant_descripcion" => 'required|string|max_length[100]',
                                "restaurant_direccion" => 'required|string|max_length[100]',
                                "restaurant_telefono" => 'required|string|max_length[100]',
                                "restaurant_horario" => 'required|string|max_length[100]'
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
                                    "restaurant_usua_id" => $datos["restaurant_usua_id"],
                                    "restaurant_descripcion" => $datos["restaurant_descripcion"],
                                    "restaurant_direccion" => $datos["restaurant_direccion"],
                                    "restaurant_telefono" => $datos["restaurant_telefono"],
                                    "restaurant_horario" => $datos["restaurant_horario"]
                                );
                                $model = new RestauranteModel();
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
                                "restaurant_usua_id" => 'required|integer',
                                "restaurant_descripcion" => 'required|string|max_length[100]',
                                "restaurant_direccion" => 'required|string|max_length[100]',
                                "restaurant_telefono" => 'required|string|max_length[100]',
                                "restaurant_horario" => 'required|string|max_length[100]'
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
                            $model = new RestauranteModel();
                            $restaurante = $model -> find($id);
                            if(is_null($restaurante)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "restaurant_usua_id" => $datos["restaurant_usua_id"],
                                    "restaurant_descripcion" => $datos["restaurant_descripcion"],
                                    "restaurant_direccion" => $datos["restaurant_direccion"],
                                    "restaurant_telefono" => $datos["restaurant_telefono"],
                                    "restaurant_horario" => $datos["restaurant_horario"]
                                );
                                $model = new RestauranteModel();
                                $restaurante = $model -> update($id, $datos);
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
                    $model = new RestauranteModel();
                    $restaurante = $model -> where('restaurant_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($restaurante)){
                        $datos = array(
                            "restaurant_estado" => 0
                        );
                        $restaurante = $model -> update($id, $datos);
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