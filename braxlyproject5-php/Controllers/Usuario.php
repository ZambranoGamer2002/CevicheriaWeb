<?php   
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;
class Usuario extends Controller{
    public function index(){
        $model = new UsuarioModel();
        $registro = $model -> getUsuario();
        //var_dump($registro); die;
        if(count($registro) == 0){
            $respuesta = array(
                "error" => true,
                "mensaje" => "No hay elemento"
            );
            $data = json_encode($respuesta);
            //var_dump($respuesta); die;
            
        }else{
            $respuesta = array(
                "Status" => 200,
                "Total de registros" => count($registro),
                "Detalles" => $registro
            );
            $data = json_encode($respuesta);
        }
        return $data;

    }

    public function show($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        
        $model = new UsuarioModel();

        if(is_numeric($id)){
            $usuario = $model -> getId($id);
        }else if(is_string($id)){
            $usuario = $model -> getLogin($id);
        }
        //var_dump($curso); die;
        if(!empty($usuario)){

            $data = array(
                "Status" => 200,
                "Detalles" => $usuario
            );
        }else{
            $data = array(
                "Status" => 404,
                "Detalles" => "No hay registros"
            );
        }
        return json_encode($data, true);
    }

    public function create(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $datos = array(
            "usa_tipousa_id" => $request -> getVar("usa_tipousa_id"),
            "usa_usanombre" => $request -> getVar("usa_usanombre"),
            "usa_contra" => $request -> getVar("usa_contra")
        );
        if(!empty($datos)){
            $validation -> setRules([
                'usa_tipousa_id' => 'required|string|required|integer',
                'usa_usanombre' => 'required|string|max_length[100]',
                'usa_contra' => 'required|string|max_length[100]'
            ]);
            $validation -> withRequest($this -> request) -> run();
            if($validation -> getErrors()){
                $errors = $validation ->getErrors();
                $data = array(
                    "Status" => 404,
                    "Detalle"=>$errors
                );
                return json_encode($data, true);
            }else{
                $usa_user_secreta = crypt($datos["usa_usanombre"].$datos["usa_contra"], '$2a$07$dfhdfrexfhgdfhdferttgsad$');
	     		$usa_llave_secreta = crypt($datos["usa_contra"].$datos["usa_usanombre"], '$2a$07$dfhdfrexfhgdfhdferttgsad$');
                $datos = array(
                    "usa_tipousa_id" => $datos["usa_tipousa_id"],
                    "usa_usanombre" => $datos["usa_usanombre"],
                    "usa_contra" => $datos["usa_contra"],
                    "usua_user_secreto" => str_replace('$','a',$usa_user_secreta),
                    "usa_llave_secreta" => str_replace('$','o',$usa_llave_secreta)
                );
                $model = new UsuarioModel();
                $registro = $model -> insert($datos);
                $data = array(
                    "Status" => 200,
                    "Detalle" => "Registro OK, guarde sus credenciales",
                    "credenciales" => array(
                        "usua_id" => $registro,
                        "reg_clientes_id" => str_replace('$','a',$usa_user_secreta),
                        "reg_llave_secreta" => str_replace('$','o',$usa_llave_secreta)
                    )
                );
                return json_encode($data, true);
            }
        }else{
            $data = array(
                "Status" => 400,
                "Detalle" => "Registro con errores"
            );
            return json_encode($data, true);
        }
    }

    public function update($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $datos = $this -> request -> getRawInput();
        if(!empty($datos)){
            $validation -> setRules([
                'usa_tipousa_id' => 'required|integer',
                'usa_usanombre' => 'required|string|max_length[100]',
                'usa_contra' => 'required|string|max_length[100]'
            ]);
            $validation -> withRequest(
                $this -> request
            ) -> run();
            if($validation -> getErrors()){
                $errors = $validation -> getErrors();
                $data = array(
                    "Status" => 404,
                    "Detalles" => $errors
                );
                return json_encode($data, true);
            }else{
                $model = new UsuarioModel();
                $usuario = $model -> find($id);
                if(is_null($usuario)){
                    $data = array(
                        "Status" => 404,
                        "Detalles" => "Registro no existe"
                    );
                    return json_encode($data, true);
                }else{      // encriptamiento lo editado
                    $usa_user_secreta = crypt($datos["usa_usanombre"].$datos["usa_contra"], '$2a$07$dfhdfrexfhgdfhdferttgsad$');
    	     		$usa_llave_secreta = crypt($datos["usa_contra"].$datos["usa_usanombre"], '$2a$07$dfhdfrexfhgdfhdferttgsad$');

                    $datos = array(
                        "usa_tipousa_id" => $datos["usa_tipousa_id"],
                        "usa_usanombre" => $datos["usa_usanombre"],
                        "usa_contra" => $datos["usa_contra"],
                        "usua_user_secreto" => str_replace('$','a',$usa_user_secreta),
                        "usa_llave_secreta" => str_replace('$','a',$usa_llave_secreta)
                    );
                    $model = new UsuarioModel();
                    $usuario = $model -> update($id, $datos);
                    $data = array(
                        "Status" => 200,
                        "Detalles" => "Datos actualizados",
                        "Nuevas credenciales" => array(
                            "reg_clientes_id" => str_replace('$','a',$usa_user_secreta),
                            "reg_llave_secreta" => str_replace('$','o',$usa_llave_secreta)
                        )
                    );
                }
            }
        }else{
            $data = array(
                "Status" => 400,
                "Detalles" => "Registro con errores"
            );
            return json_encode($data, true);
        }
                
        return json_encode($data, true);
    }


    public function delete($id){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $headers = $request -> getHeaders();
        $model = new UsuarioModel();
        $usuario = $model -> where('usua_estado',1) -> find($id);
        if(!empty($usuario)){
            $datos = array(
                "usua_estado" => 0
            );
            $usuario = $model -> update($id, $datos);
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
    }
}
