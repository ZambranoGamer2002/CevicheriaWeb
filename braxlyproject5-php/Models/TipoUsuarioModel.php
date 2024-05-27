<?php
namespace App\Models;
use CodeIgniter\Model;
class TipoUsuarioModel extends Model{
    protected $table = 'tipo_usuario';
    protected $primaryKey = 'tipousa_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'tipousa_descripcion',
        'tipo_estado'
    ];
}