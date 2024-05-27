<?php
namespace App\Models;
use CodeIgniter\Model;
class DetalleComprobanteModel extends Model{
    protected $table = 'detalle_comprobante';
    protected $primaryKey = 'detacompro_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'detacompro_compro_id',
        'detacompro_plato_id',
        'detacompro_cantidad',
        'detacompro_subtotal',
        'detacompro_estado' 
    ];

    public function getDetalleComprobante(){
        return $this -> db -> table('detalle_comprobante dc')
        -> where('dc.detacompro_estado', 1)
        -> join('comprobante c', 'c.compro_id = dc.detacompro_compro_id')
        -> join('plato pl', 'pl.plato_id = dc.detacompro_plato_id')
        -> get() -> getResultArray();
    }
 
    public function getId($id){
        return $this -> db -> table('detalle_comprobante dc')
        -> where('dc.detacompro_id', $id)
        -> where('dc.detacompro_estado', 1)
        -> join('comprobante c', 'c.compro_id = dc.detacompro_compro_id')
        -> join('plato pl', 'pl.plato_id = dc.detacompro_plato_id')
        -> get() -> getResultArray();
    }

    public function getComprobante(){
        return $this -> db -> table('comprobante c')
        -> where('c.compro_estado', 1)
        -> get() -> getResultArray();
    }
    public function getPlato(){
        return $this -> db -> table('plato pl')
        -> where('pl.plato_estado', 1)
        -> get() -> getResultArray();
    }
}