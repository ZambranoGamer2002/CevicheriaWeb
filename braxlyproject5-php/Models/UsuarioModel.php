<?php
namespace App\Models;
use CodeIgniter\Model;
class UsuarioModel extends Model{
    protected $table = 'usuario';
    protected $primaryKey = 'usa_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'usa_tipousa_id',
        'usa_usanombre',
        'usa_contra',
        'usa_user_secreta',
        'usa_llave_secreta',
        'usa_estado'
    ];

    public function getUsuario(){
        return $this -> db -> table('usuario u')
        -> where('u.usa_estado', 1)
        -> join('tipo_usuario tu', 'u.usa_tipousa_id = tu.tipousa_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('usuario u')
        -> where('u.usa_id', $id)
        -> where('u.usa_estado', 1)
        -> join('tipo_usuario tu', 'u.usa_tipousa_id = tu.tipousa_id')
        -> get() -> getResultArray();
    }

    public function getLogin($usu){
        $usuario = explode('&', $usu);
        if(count($usuario) == 2){
            $usuarios = $usuario[0];
            $password = $usuario[1];
            //$sucursal = $usuario[2];
            return $this -> db -> table('usuario u')
            ->where('u.usa_usanombre', $usuarios)
            ->where('u.usa_contra', $password)
            ->where('u.usa_estado', 1)
            ->join('tipo_usuario tu', 'u.usa_tipousa_id = tu.tipousa_id')
            ->get()->getResultArray();
        }else{
            return 'El usuario no es valido';
        }
    }
    public function getTipoUsuario(){
        return $this -> db -> table('tipo_usuario tu')
        -> where('tu.tipo_estado', 1)
        -> get() -> getResultArray();
    }
}