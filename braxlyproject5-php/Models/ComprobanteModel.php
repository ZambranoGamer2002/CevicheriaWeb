<?php
namespace App\Models;
use CodeIgniter\Model;
class ComprobanteModel extends Model{
    protected $table = 'comprobante';
    protected $primaryKey = 'compro_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'compro_restaurante_id',
        'compro_clien_id',
        'compro_pedido_id',
        'compro_fecha',
        'compro_subtotal',
        'compro_total',
        'compro_estado'
    ];

    public function getComprobante(){
        return $this -> db -> table('comprobante c')
        -> where('c.compro_estado', 1)
        -> join('restaurante r', 'r.restaurant_id = c.compro_restaurante_id')
        -> join('cliente cl', 'cl.clien_id = c.compro_clien_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('comprobante c')
        -> where('c.compro_id', $id)
        -> where('c.compro_estado', 1)
        -> join('restaurante r', 'r.restaurant_id = c.compro_restaurante_id')
        -> join('cliente cl', 'cl.clien_id = c.compro_clien_id')
        -> get() -> getResultArray();
    }

    public function getRestaurante(){
        return $this -> db -> table('restaurante r')
        -> where('r.restaurant_estado', 1)
        -> get() -> getResultArray();
    }
    public function getCliente(){
        return $this -> db -> table('cliente cl')
        -> where('cl.clien_estado', 1)
        -> get() -> getResultArray();
    }
}