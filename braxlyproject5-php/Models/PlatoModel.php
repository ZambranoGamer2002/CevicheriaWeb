<?php
namespace App\Models;
use CodeIgniter\Model;
class PlatoModel extends Model{
    protected $table = 'plato';
    protected $primaryKey = 'plato_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'plato_tipoplato_id',
        'plato_nombre',
        'pedido_descrip',
        'plato_precio',
        'plato_foto',
        'plato_estado'
    ];

    public function getPlato(){
        return $this -> db -> table('plato p')
        -> where('p.plato_estado', 1)
        -> join('tipo_plato tp', 'tp.tipoplato_id = p.plato_tipoplato_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('plato p')
        -> where('p.plato_id', $id)
        -> where('p.plato_estado', 1)
        -> join('tipo_plato tp', 'tp.tipoplato_id = p.plato_tipoplato_id')
        -> get() -> getResultArray();
    }

    public function getTipoPlato(){
        return $this -> db -> table('tipo_plato tp')
        -> where('tp.tipoplato_estado', 1)
        -> get() -> getResultArray();
    }
}