<?php
namespace App\Models;
use CodeIgniter\Model;
class ClienteModel extends Model{
    protected $table = 'cliente';
    protected $primaryKey = 'clien_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'clien_usua_id',
        'clien_nombres',
        'clien_apellidos',
        'clien_foto',
        'clien_dni',
        'clie_correo',
        'clien_celular',
        'clien_genero',
        'clien_estado'
    ];

    public function getCliente(){
        return $this -> db -> table('cliente c')
        -> where('c.clien_estado', 1)
        -> join('usuario u', 'u.usa_id = c.clien_usua_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('cliente c')
        -> where('c.clien_usua_id', $id)
        -> where('c.clien_estado', 1)
        -> join('usuario u', 'u.usa_id = c.clien_usua_id')
        -> get() -> getResultArray();
    }

    public function getUsuario(){
        return $this -> db -> table('usuario u')
        -> where('u.usa_estado', 1)
        -> get() -> getResultArray();
    }
}