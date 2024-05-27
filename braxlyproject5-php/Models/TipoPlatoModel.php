<?php
namespace App\Models;
use CodeIgniter\Model;
class TipoPlatoModel extends Model{
    protected $table = 'tipo_plato';
    protected $primaryKey = 'tipoplato_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'tipoplato_nombre',
        'tipoplato_estado'
    ];
}