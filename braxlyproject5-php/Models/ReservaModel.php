<?php
namespace App\Models;
use CodeIgniter\Model;
class ReservaModel extends Model{
    protected $table = 'reserva';
    protected $primaryKey = 'reserva_id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'reserva_mesa_id',
        'reserva_clien_id',
        'reserva_asiento',
        'reserva_fecha',
        'reserva_hora',
        'reserva_nombre_perso',
        'reserva_numero_cell',
        'reserva_dni_perso',
        'rese_estado'

    ];

    public function getReserva(){
        return $this -> db -> table('reserva r')
        -> where('r.rese_estado', 1)
        -> join('mesa m', 'm.mesa_id = r.reserva_mesa_id')
        -> join('cliente c', 'c.clien_id = r.reserva_clien_id')
        -> get() -> getResultArray();
    }

    public function getId($id){
        return $this -> db -> table('reserva r')
        -> where('r.reserva_id', $id)
        -> where('r.rese_estado', 1)
        -> join('mesa m', 'm.mesa_id = r.reserva_mesa_id')
        -> join('cliente c', 'c.clien_id = r.reserva_clien_id')
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
    public function obtenerReservasPorCliente($cliente_id) {
        // Realizar la consulta para obtener las reservas relacionadas al cliente
        return $this -> db -> table('reserva r')
        -> where('r.rese_estado', 1)
        -> where('r.reserva_clien_id', $cliente_id)
        -> join('cliente c', 'c.clien_id = r.reserva_clien_id')
        -> join('mesa m', 'm.mesa_id = r.reserva_mesa_id')
        -> get() -> getResultArray();
    }
}