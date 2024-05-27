<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PedidoModel;
use App\Models\UsuarioModel;
class Pedido extends Controller{

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
                    $model = new PedidoModel();
                    $pedido = $model -> getPedido();
                    if(!empty($pedido)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($pedido),
                            "Detalles" => $pedido
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
                    $model = new PedidoModel();
                    $pedido = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($pedido)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $pedido
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
                            "pedido_mesa_id" => $request -> getVar("pedido_mesa_id"),
                            "pedido_clien_id" => $request -> getVar("pedido_clien_id"),
                            "pedido_tipo_pedi" => $request -> getVar("pedido_tipo_pedi"),
                            "pedido_fecha" => $request -> getVar("pedido_fecha"),
                            "pedido_total" => $request -> getVar("pedido_total")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "pedido_mesa_id" => 'required|integer',
                                "pedido_clien_id" => 'required|integer',
                                "pedido_tipo_pedi" => 'required|string|max_length[40]',
                                "pedido_fecha" => 'required|Date',
                                "pedido_total" => 'required|integer'
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
                                    "pedido_mesa_id" => $datos["pedido_mesa_id"],
                                    "pedido_clien_id" => $datos["pedido_clien_id"],
                                    "pedido_tipo_pedi" => $datos["pedido_tipo_pedi"],
                                    "pedido_fecha" => $datos["pedido_fecha"],
                                    "pedido_total" => $datos["pedido_total"]
                                );
                                $model = new PedidoModel();
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
                            "pedido_mesa_id" => 'required|integer',
                            "pedido_clien_id" => 'required|integer',
                            "pedido_tipo_pedi" => 'required|string|max_length[40]',
                            "pedido_fecha" => 'required|Date',
                            "pedido_total" => 'required|integer'
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
                            $model = new PedidoModel();
                            $pedido = $model -> find($id);
                            if(is_null($pedido)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "pedido_mesa_id" => $datos["pedido_mesa_id"],
                                    "pedido_clien_id" => $datos["pedido_clien_id"],
                                    "pedido_tipo_pedi" => $datos["pedido_tipo_pedi"],
                                    "pedido_fecha" => $datos["pedido_fecha"],
                                    "pedido_total" => $datos["pedido_total"]
                                );
                                $model = new PedidoModel();
                                $pedido = $model -> update($id, $datos);
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
                    $model = new PedidoModel();
                    $pedido = $model -> where('pedido_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($pedido)){
                        $datos = array(
                            "pedido_estado" => 0
                        );
                        $pedido = $model -> update($id, $datos);
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