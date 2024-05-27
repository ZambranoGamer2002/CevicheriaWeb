<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\PedidoDeliveryModel;
use App\Models\UsuarioModel;
class PedidoDelivery extends Controller{

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
                    $model = new PedidoDeliveryModel();
                    $pedidoDelivery = $model -> getPedidoDelivery();
                    if(!empty($pedidoDelivery)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($pedidoDelivery),
                            "Detalles" => $pedidoDelivery
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
                    $model = new PedidoDeliveryModel();
                    $pedidoDelivery = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($pedidoDelivery)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $pedidoDelivery
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
                            "pedelivery_pedi_id" => $request -> getVar("pedelivery_pedi_id"),
                            "pedelivery_direccion" => $request -> getVar("pedelivery_direccion"),
                            "pedelivery_numero_clien" => $request -> getVar("pedelivery_numero_clien"),
                            "dedelivery_estado_pedido" => $request -> getVar("dedelivery_estado_pedido")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "pedelivery_pedi_id" => 'required|integer',
                                "pedelivery_direccion" => 'required|string|max_length[255]',
                                "pedelivery_numero_clien" => 'required|string|max_length[100]',
                                "dedelivery_estado_pedido" => 'required|string|max_length[100]'
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
                                    "pedelivery_pedi_id" => $datos["pedelivery_pedi_id"],
                                    "pedelivery_direccion" => $datos["pedelivery_direccion"],
                                    "pedelivery_numero_clien" => $datos["pedelivery_numero_clien"],
                                    "dedelivery_estado_pedido" => $datos["dedelivery_estado_pedido"]
                                );
                                $model = new PedidoDeliveryModel();
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
                            "pedelivery_pedi_id" => 'required|integer',
                            "pedelivery_direccion" => 'required|string|max_length[255]',
                            "pedelivery_numero_clien" => 'required|string|max_length[100]',
                            "dedelivery_estado_pedido" => 'required|string|max_length[100]'
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
                            $model = new PedidoDeliveryModel();
                            $pedidoDelivery = $model -> find($id);
                            if(is_null($pedidoDelivery)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "pedelivery_pedi_id" => $datos["pedelivery_pedi_id"],
                                    "pedelivery_direccion" => $datos["pedelivery_direccion"],
                                    "pedelivery_numero_clien" => $datos["pedelivery_numero_clien"],
                                    "dedelivery_estado_pedido" => $datos["dedelivery_estado_pedido"]
                                );
                                $model = new PedidoDeliveryModel();
                                $pedidoDelivery = $model -> update($id, $datos);
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
                    $model = new PedidoDeliveryModel();
                    $pedidoDelivery = $model -> where('dedelivery_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($pedidoDelivery)){
                        $datos = array(
                            "dedelivery_estado" => 0
                        );
                        $pedidoDelivery = $model -> update($id, $datos);
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