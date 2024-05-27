<?php
namespace App\Models;
use CodeIgniter\Model;
class MesaModel extends Model{
    protected $table = 'mesa';
    protected $primaryKey = 'mesa_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'mesa_resta_id',
        'mesa_ubicacion',
        'mesa_numero',
        'mesa_cantidad_asientos',
        'mesa_estado'
    ];

    public function getMesa(){
        return $this -> db -> table('mesa m')
        -> where('m.mesa_estado', 1)
        -> join('restaurante r', 'r.restaurant_id = m.mesa_resta_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('mesa m')
        -> where('m.mesa_id', $id)
        -> where('m.mesa_estado', 1)
        -> join('restaurante r', 'r.restaurant_id = m.mesa_resta_id')
        -> get() -> getResultArray();
    }
    public function getRestaurante(){
        return $this -> db -> table('restaurante r')
        -> where('r.restaurant_estado', 1)
        -> get() -> getResultArray();
    }
}