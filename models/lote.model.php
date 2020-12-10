<?php
require_once 'models/conection.model.php';

class LoteModel extends ConectionModel {

    public function ciudadYLabAsociado($numLote){
        $sentencia = $this->db->prepare("SELECT ciudad.id, laboratorio.id FROM Lote JOIN ciudad JOIN laborario ON lote.id_ciudad = ciudad.id AND lote.id_laboratio = laboratorio.id WHERE lote = ?");
        $sentencia->execute([$numLote]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

    }

    public function cumpleTemperatura($ciudad){
        $sentencia = $this->db->prepare("SELECT ciudad.temperatura_conservacion, laboratorio.temperatura_requerida FROM lote JOIN ciudad JOIN laborario ON ciudad.temperatura_conservacion <= laboratorio.temperatura_requerida WHERE ciudad = ?");
        $sentencia->execute([$ciudad]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);

    }

    public function agregarLote($numLote, $añoVenc, $ciudad, $lab){
        $sentencia = $this->db->prepare("INSERT INTO Lote (nro_lote, año_vencimiento, id_ciudad, id_laboratorio) VALUES (?,?,?,?)");
        $sentencia->execute([$numLote, $añoVenc, $ciudad, $lab]);
    }

    public function obtenerLotes ($id){
        $sentencia = $this->db->prepare("SELECT ciudad.nombre, lote.nro_lote, lote.año_vencimiento FROM ciudad JOIN lotes ON lote.id_ciudad = ciudad.id WHERE ciudad.id = ?");
        $sentencia->execute([$id]);
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
}