<?php
namespace App\Models;
use CodeIgniter\Model;
class PedidoModel extends Model{
    protected $table = 'pedido';
    protected $primaryKey = 'pedido_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'pedido_mesa_id',
        'pedido_clien_id',
        'pedido_tipo_pedi',
        'pedido_fecha',
        'pedido_total',
        'pedido_estado'
    ];

    public function getPedido(){
        return $this -> db -> table('pedido p')
        -> where('p.pedido_estado', 1)
        -> join('mesa m', 'm.mesa_id = p.pedido_mesa_id')
        -> join('cliente c', 'c.clien_id = p.pedido_clien_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('pedido p')
        -> where('p.pedido_id', $id)
        -> where('p.pedido_estado', 1)
        -> join('mesa m', 'm.mesa_id = p.pedido_mesa_id')
        -> join('cliente c', 'c.clien_id = p.pedido_clien_id')
        -> get() -> getResultArray();
    }

    public function getMesa(){
        return $this -> db -> table('mesa m')
        -> where('m.mesa_estado', 1)
        -> get() -> getResultArray();
    }
    public function getCliente(){
        return $this -> db -> table('cliente c')
        -> where('c.clien_estado', 1)
        -> get() -> getResultArray();
    }
}