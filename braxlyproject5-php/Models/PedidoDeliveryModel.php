<?php
namespace App\Models;
use CodeIgniter\Model;
class PedidoDeliveryModel extends Model{
    protected $table = 'pedido_delivery';
    protected $primaryKey = 'pedelivery_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'pedelivery_pedi_id',
        'pedelivery_direccion',
        'pedelivery_numero_clien',
        'dedelivery_estado_pedido',
        'dedelivery_estado'
    ];

    public function getPedidoDelivery(){
        return $this -> db -> table('pedido_delivery pd')
        -> where('pd.dedelivery_estado', 1)
        -> join('pedido p', 'p.pedido_id = pd.pedelivery_pedi_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('pedido_delivery pd')
        -> where('pd.dede_id', $id)
        -> where('pd.dedelivery_estado', 1)
        -> join('pedido p', 'p.pedido_id = pd.pedelivery_pedi_id')
        -> get() -> getResultArray();
    }

    public function getPedido(){
        return $this -> db -> table('pedido p')
        -> where('p.pedido_estado', 1)
        -> get() -> getResultArray();
    }
}