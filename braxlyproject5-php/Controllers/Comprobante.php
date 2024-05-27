<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ComprobanteModel;
use App\Models\UsuarioModel;
class Comprobante extends Controller{

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
                    $model = new ComprobanteModel();
                    $comprobante = $model -> getComprobante();
                    if(!empty($comprobante)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($comprobante),
                            "Detalles" => $comprobante
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
                    $model = new ComprobanteModel();
                    $comprobante = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($comprobante)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $comprobante
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
                            "compro_restaurante_id" => $request -> getVar("compro_restaurante_id"),
                            "compro_clien_id" => $request -> getVar("compro_clien_id"),
                            "compro_pedido_id" => $request -> getVar("compro_pedido_id"),
                            "compro_fecha" => $request -> getVar("compro_fecha"),
                            "compro_subtotal" => $request -> getVar("compro_subtotal"),                     
                            "compro_total" => $request -> getVar("compro_total")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "compro_restaurante_id" => 'required|integer',
                                "compro_clien_id" => 'required|integer',
                                "compro_pedido_id" => 'required|integer',
                                "compro_fecha" => 'required|Date',
                                "compro_subtotal" => 'required|integer',
                                "compro_total" => 'required|integer'
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
                                    "compro_restaurante_id" => $datos["compro_restaurante_id"],
                                    "compro_clien_id" => $datos["compro_clien_id"],
                                    "compro_pedido_id" => $datos["compro_pedido_id"],
                                    "compro_fecha" => $datos["compro_fecha"],
                                    "compro_subtotal" => $datos["compro_subtotal"],
                                    "compro_total" => $datos["compro_total"]
                                );
                                $model = new ComprobanteModel();
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
                            "compro_restaurante_id" => 'required|integer',
                            "compro_clien_id" => 'required|integer',
                            "compro_pedido_id" => 'required|integer',
                            "compro_fecha" => 'required|Date',
                            "compro_subtotal" => 'required|integer',                
                            "compro_total" => 'required|integer'
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
                            $model = new ComprobanteModel();
                            $comprobante = $model -> find($id);
                            if(is_null($comprobante)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "compro_restaurante_id" => $datos["compro_restaurante_id"],
                                    "compro_clien_id" => $datos["compro_clien_id"],
                                    "compro_pedido_id" => $datos["compro_pedido_id"],
                                    "compro_fecha" => $datos["compro_fecha"],
                                    "compro_subtotal" => $datos["compro_subtotal"],
                                    "compro_total" => $datos["compro_total"]
                                );
                                $model = new ComprobanteModel();
                                $comprobante = $model -> update($id, $datos);
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
                    $model = new ComprobanteModel();
                    $comprobante = $model -> where('compro_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($comprobante)){
                        $datos = array(
                            "compro_estado" => 0
                        );
                        $comprobante = $model -> update($id, $datos);
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