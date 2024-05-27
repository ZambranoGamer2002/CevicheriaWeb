<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ReservaModel;
use App\Models\UsuarioModel;
class Reserva extends Controller{

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
                    $model = new ReservaModel();
                    $reserva = $model -> getReserva();
                    if(!empty($reserva)){
                        $data = array(
                            "Status" => 200, 
                            "Total de registros" => count($reserva),
                            "Detalles" => $reserva
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
                    $model = new ReservaModel();
                    $reserva = $model -> getId($id);
                    //var_dump($curso); die;
                    if(!empty($reserva)){
                        $data = array(
                            "Status" => 200,
                            "Detalles" => $reserva
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
                            "reserva_mesa_id" => $request -> getVar("reserva_mesa_id"),
                            "reserva_clien_id" => $request -> getVar("reserva_clien_id"),
                            "reserva_asiento" => $request -> getVar("reserva_asiento"),
                            "reserva_fecha" => $request -> getVar("reserva_fecha"),
                            "reserva_hora" => $request -> getVar("reserva_hora"),
                            "reserva_nombre_perso" => $request -> getVar("reserva_nombre_perso"),
                            "reserva_numero_cell" => $request -> getVar("reserva_numero_cell"),
                            "reserva_dni_perso" => $request -> getVar("reserva_dni_perso")
                        );
                        if(!empty($datos)){
                            $validation -> setRules([
                                "reserva_mesa_id" => 'required|integer',
                                "reserva_clien_id" => 'required|integer',
                                "reserva_asiento" => 'required|integer',
                                "reserva_fecha" => 'required|date',
                                "reserva_hora" => 'required|string|max_length[10]',
                                "reserva_nombre_perso" => 'required|string|max_length[100]',
                                "reserva_numero_cell" => 'required|string|max_length[100]',
                                "reserva_dni_perso" => 'required|integer'
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
                                    "reserva_mesa_id" => $datos["reserva_mesa_id"],
                                    "reserva_clien_id" => $datos["reserva_clien_id"],
                                    "reserva_asiento" => $datos["reserva_asiento"],
                                    "reserva_fecha" => $datos["reserva_fecha"],
                                    "reserva_hora" => $datos["reserva_hora"],
                                    "reserva_nombre_perso" => $datos["reserva_nombre_perso"],
                                    "reserva_numero_cell" => $datos["reserva_numero_cell"],
                                    "reserva_dni_perso" => $datos["reserva_dni_perso"]
                                );  
                                $model = new ReservaModel();
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
                            "reserva_mesa_id" => 'required|integer',
                            "reserva_clien_id" => 'required|integer',
                            "reserva_asiento" => 'required|integer',
                            "reserva_fecha" => 'required|date',
                            "reserva_hora" => 'required|string|max_length[10]',
                            "reserva_nombre_perso" => 'required|string|max_length[100]',
                            "reserva_numero_cell" => 'required|string|max_length[100]',
                            "reserva_dni_perso" => 'required|integer'
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
                            $model = new ReservaModel();
                            $reserva = $model -> find($id);
                            if(is_null($reserva)){
                                $data = array(
                                    "Status" => 404,
                                    "Detalles" => "Registro no existe"
                                );
                                return json_encode($data, true);
                            }else{
                                $datos = array(
                                    "reserva_mesa_id" => $datos["reserva_mesa_id"],
                                    "reserva_clien_id" => $datos["reserva_clien_id"],
                                    "reserva_asiento" => $datos["reserva_asiento"],
                                    "reserva_fecha" => $datos["reserva_fecha"],
                                    "reserva_hora" => $datos["reserva_hora"],
                                    "reserva_nombre_perso" => $datos["reserva_nombre_perso"],
                                    "reserva_numero_cell" => $datos["reserva_numero_cell"],
                                    "reserva_dni_perso" => $datos["reserva_dni_perso"]

                                );
                                $model = new ReservaModel();
                                $reserva = $model -> update($id, $datos);
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
                    $model = new ReservaModel();
                    $reserva = $model -> where('reserva_estado',1) -> find($id);
                    //var_dump($curso); die;
                    if(!empty($reserva)){
                        $datos = array(
                            "reserva_estado" => 0
                        );
                        $reserva = $model -> update($id, $datos);
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