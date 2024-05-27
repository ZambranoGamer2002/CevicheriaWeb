<?php
namespace App\Models;
use CodeIgniter\Model;
class RestauranteModel extends Model{
    protected $table = 'restaurante';
    protected $primaryKey = 'restaurant_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'restaurant_usua_id',
        'restaurant_descripcion',
        'restaurant_direccion',
        'restaurant_telefono',
        'restaurant_horario',
        'restaurant_estado'
    ];

    public function getRestaurante(){
        return $this -> db -> table('restaurante r')
        -> where('r.restaurant_estado', 1)
        -> join('usuario u', 'u.usa_id = r.restaurant_usua_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('restaurante r')
        -> where('r.restaurant_id', $id)
        -> where('r.restaurant_estado', 1)
        -> join('usuario u', 'u.usa_id = r.restaurant_usua_id')
        -> get() -> getResultArray();
    }
    public function getUsuario(){
        return $this -> db -> table('usuario u')
        -> where('u.usa_estado', 1)
        -> get() -> getResultArray();
    }
}